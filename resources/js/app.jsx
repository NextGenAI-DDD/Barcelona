import React from 'react';
import { createRoot } from 'react-dom/client';
import './app.js';
import AppLayout from './components/AppLayout';
import { getPageConfig } from './utils/pageConfig';

const bootstrapReactApp = () => {
  const layoutRoot = document.getElementById('layout-root');
  if (!layoutRoot) {
    return;
  }

  const { page, pageProps } = getPageConfig(layoutRoot.dataset);

  const root = createRoot(layoutRoot);
  root.render(<AppLayout page={page} pageProps={pageProps} />);
};

bootstrapReactApp();