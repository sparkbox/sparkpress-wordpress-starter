import rollbar from 'rollbar';

// eslint-disable-next-line new-cap
window.Rollbar = new rollbar({
  accessToken: process.env.ROLLBAR_CLIENT_ITEM_TOKEN,
  captureUncaught: true,
  captureUnhandledRejections: true,
  payload: {
    environment: process.env.WP_ENV,
  },
});
