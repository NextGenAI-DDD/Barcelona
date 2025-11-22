import React, { useEffect } from 'react';
import Topbar from './Topbar';
import Navbar from './Navbar';
import Footer from './Footer';
import BackToTopButton from './BackToTopButton';
import WelcomePage from '../pages/WelcomePage';

const pageRegistry = {
  welcome: WelcomePage,
};

const AppLayout = ({ page = 'welcome', pageProps = {}, locale = 'en' }) => {
  const PageComponent = pageRegistry[page] || null;

  useEffect(() => {
    if (typeof document !== 'undefined' && locale) {
      document.documentElement.setAttribute('lang', locale);
    }
  }, [locale]);

  return (
    <>
      <Topbar />
      <Navbar />
      <main className="py-4">{PageComponent ? <PageComponent {...pageProps} /> : null}</main>
      <BackToTopButton />
      <Footer />
    </>
  );
};

export default AppLayout;


