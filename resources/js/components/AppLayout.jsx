import React from 'react';
import Topbar from './Topbar';
import Navbar from './Navbar';
import Footer from './Footer';
import BackToTopButton from './BackToTopButton';
import WelcomePage from '../pages/WelcomePage';

const pageRegistry = {
  welcome: WelcomePage,
};

const AppLayout = ({ page = 'welcome', pageProps = {} }) => {
  const PageComponent = pageRegistry[page] || null;

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


