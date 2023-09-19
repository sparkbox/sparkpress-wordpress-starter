import { defineConfig } from 'vitest/config';

export default defineConfig({
  test: {
    coverage: {
      provider: 'istanbul',
      include: ['src/**/*'],
      exclude: ['**/vendor/**/*'],
      all: true,
    },
    environment: 'jsdom',
  },
});
