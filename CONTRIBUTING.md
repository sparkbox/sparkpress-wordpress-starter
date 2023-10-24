# Contributing

Hey! You're thinking about contributing? That's awesome! You're awesome. Don't know where to start? The best place to get started is visiting our [issues][issues] to see if there are any you'd like to tackle.

Here's a few things you should know before you submit your PR:

1. The purpose of this project is to make getting up and running on a WordPress project quick and simple. By design, it has minimal styles and functionality.
1. All contributions must follow our [code of conduct](code-of-conduct.md)

## Steps to submit a PR

- Clone/Fork the repo
- Install dependencies: `npm install`
- Start the development process `npm start`
- Ensure linters pass: `npm run lint`
- Ensure tests pass: `npm test`
- Make changes and then make sure the linters and tests still pass
- Push your branch/fork and [submit a PR][pr]
- Assign a [sparkboxer][contributors] to review your PR

## Commit Style

We use [Conventional Commits][conventional commits] on this project. Commit messages must be prefixed with a valid commit type and the commit type cannot be prefixed with any additional text.

Supported commit types include `feat`, `fix`, `chore`, `docs`, `style`, `refactor`, and `test`.

Valid example:

```sh
feat: add new linting rule for ...
```

Invalid examples:

```sh
feature: add new linting rule for ...
```

```sh
:sparkles: feat: add new linting rule for ...
```

ℹ️ See the [Conventional Commits][conventional commits] page for further details on available commit types and how to handle breaking changes.

[issues]: ./issues
[pr]: ./compare
[contributors]: ./graphs/contributors
[conventional commits]: https://www.conventionalcommits.org/en/v1.0.0/
