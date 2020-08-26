import React, { Component } from 'react'; // eslint-disable-line no-unused-vars

class ErrorBoundary extends Component {
  constructor(props) {
    super(props);
    this.state = { hasError: false };
  }

  componentDidCatch(error, info) {
    this.setState({ hasError: true });
    const { errorLogger, componentName } = this.props;
    const stackTrace = info.componentStack || 'No trace info available.';
    if (errorLogger) {
      errorLogger(new Error(`[ERROR] ${componentName}:${error}. Stack trace: ${stackTrace}`));
    }
  }

  render() {
    const { hasError } = this.state;
    const { children } = this.props;

    if (hasError) {
      return <h1>Sorry, we encountered an error</h1>;
    }

    return children;
  }
}

export default ErrorBoundary;
