const { writeFileSync } = require('fs');
const { join } = require('path');
const prompts = require('prompts');

const getScriptTemplate = ({
	name,
	label,
	abstractClassName,
	boxIdentifier,
	postTypes,
	context,
	priority,
}) => `<?php
/**
 * File for setting up the ${name} meta box.
 */

/**
 * Class that handles all functionality for the ${name} meta box.
 */
abstract class ${abstractClassName} {
	/**
	 * Set up and add the meta box.
	 */
	public static function add() {
		/**
		 * Set up basic details about the meta box.
		 *
		 * @see https://developer.wordpress.org/reference/functions/add_meta_box/
		 */
		add_meta_box(
			'${boxIdentifier}_id',
			'${name}',
			array( self::class, '${boxIdentifier}_html' ),
			array( ${postTypes.map((postType) => `'${postType}'`).join(', ')} ),
			'${context}',
			'${priority}',
		);
	}

	/**
	 * Save the meta box selections.
	 *
	 * @param int $post_id  The post ID.
	 */
	public static function save( $post_id ) {
		if ( ! isset( $_POST['${boxIdentifier}_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['${boxIdentifier}_nonce'] ), basename( __FILE__ ) ) ) {
			return $post_id;
		}

		$post = get_post( $post_id );
		$post_type = get_post_type_object( $post->post_type );
		if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
			return $post_id;
		}

		if ( array_key_exists( '${boxIdentifier}', $_POST ) ) {
			update_post_meta(
				$post_id,
				'_${boxIdentifier}',
				sanitize_text_field( wp_unslash( $_POST['${boxIdentifier}'] ) )
			);
		}
	}

	/**
	 * Display the meta box HTML to the user.
	 *
	 * @param WP_Post $post   Post object.
	 */
	public static function ${boxIdentifier}_html( $post ) {
		wp_nonce_field( basename( __FILE__ ), '${boxIdentifier}_nonce' );
		$value = get_post_meta( $post->ID, '_${boxIdentifier}', true );
		?>
		<div>
			<label for="${boxIdentifier}">${label}</label>
			<div>
				<input id="${boxIdentifier}" type="text" name="${boxIdentifier}" value="<?php echo esc_attr( $value ); ?>">
			</div>
		</div>
		<?php
	}
}

add_action( 'add_meta_boxes', array( '${abstractClassName}', 'add' ) );
add_action( 'save_post', array( '${abstractClassName}', 'save' ) );
`;

const getDetails = async () => {
	const questions = [
		{
			type: 'text',
			name: 'name',
			message: 'What should the meta box be called?',
		},
		{
			type: 'text',
			name: 'label',
			message: 'What should be the label for the field?',
		},
		{
			type: 'list',
			name: 'postTypes',
			message:
				'Which post types should this meta box be enabled for? Enter post type slugs separated by commas (the slugs should match the first argument used in register_post_type).',
			initial: 'post',
			separator: ',',
		},
		{
			type: 'select',
			name: 'context',
			message: 'In which context should the box be displayed by default? (It can be moved by admins later)',
			choices: [
				{
					title: 'side (in the sidebar)',
					value: 'side',
				},
				{
					title: 'normal (below the post body)',
					value: 'normal',
				},
				{
					title: 'advanced (below the post body and "normal" meta boxes)',
					value: 'advanced',
				},
			],
			initial: 0,
		},
		{
			type: 'select',
			name: 'priority',
			message:
				'What priority level should be used for placing this box by default? (It can be moved by admins later)',
			choices: [
				{
					title: 'high',
					value: 'high',
				},
				{
					title: 'core',
					value: 'core',
				},
				{
					title: 'default',
					value: 'default',
				},
				{
					title: 'low',
					value: 'low',
				},
			],
			initial: 2,
		},
	];

	const response = await prompts(questions);

	return response;
};

const generatePageTemplate = async () => {
	const { name, label, postTypes, context, priority } = await getDetails();
	const abstractClassName = name.replace(/\W/g, '_');
	const boxIdentifier = name.toLowerCase().replace(/\W/g, '_');
	const templateDetails = { name, label, abstractClassName, boxIdentifier, postTypes, context, priority };

	const scriptTemplate = getScriptTemplate(templateDetails);

	const fileName = `class-${name.toLowerCase().replace(/\W/g, '-')}`;
	const scriptPath = join(__dirname, '../src/php/inc/meta-boxes', `${fileName}.php`);

	writeFileSync(scriptPath, scriptTemplate, 'utf-8');
	console.log(`Created ${scriptPath}`);
};

generatePageTemplate();
