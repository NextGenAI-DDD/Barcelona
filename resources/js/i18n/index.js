import i18n from 'i18next';
import { initReactI18next } from 'react-i18next';
import { translationResources } from './resources';

const defaultLocale = 'en';

export const initializeI18n = (locale = defaultLocale) => {
  if (!i18n.isInitialized) {
    i18n.use(initReactI18next).init({
      resources: translationResources,
      fallbackLng: defaultLocale,
      lng: locale || defaultLocale,
      interpolation: {
        escapeValue: false,
      },
      initImmediate: false,
    });
  } else if (locale && i18n.language !== locale) {
    i18n.changeLanguage(locale);
  }

  return i18n;
};

export default i18n;

