const safeParseJSON = (value, fallback) => {
  if (!value) {
    return fallback;
  }

  try {
    return JSON.parse(value);
  } catch (error) {
    console.warn('Unable to parse JSON payload:', error);
    return fallback;
  }
};

export const getPageConfig = (dataset = {}) => {
  const page = dataset.page || 'welcome';
  const pageProps = safeParseJSON(dataset.pageProps, {});

  return { page, pageProps };
};


