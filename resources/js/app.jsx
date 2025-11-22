import React from 'react';
import { createRoot } from 'react-dom/client';
import './app.js';
import AppLayout from './components/AppLayout';
import { getPageConfig } from './utils/pageConfig';
import { initializeI18n } from './i18n';

const bootstrapReactApp = () => {
  const layoutRoot = document.getElementById('layout-root');
  if (!layoutRoot) {
    return;
  }

  const { page, pageProps, locale } = getPageConfig(layoutRoot.dataset);

  initializeI18n(locale);

  const root = createRoot(layoutRoot);
  root.render(<AppLayout page={page} pageProps={pageProps} locale={locale} />);
};

bootstrapReactApp();