import React from 'react';
import { useTranslation } from 'react-i18next';

const Topbar = () => {
  const { t } = useTranslation();
  const socialLinks = [
    {
      href: 'https://www.facebook.com/fcbarcelona/?locale2=pl_PL&paipv=0&eav=Afb2n5L1Tx-Mt3jgHGiTtzg09mMnoV8wj5UVSwcpIQZsAUtkFcYDSZy7hChMuobcaro&_rdr',
      icon: 'fab fa-facebook-f',
    },
    { href: 'https://twitter.com/FCBarcelona', icon: 'fab fa-twitter' },
    { href: 'https://www.linkedin.com/in/adrian-kemski-7840b1251/', icon: 'fab fa-linkedin-in' },
    { href: 'https://www.instagram.com/fcbarcelona/', icon: 'fab fa-instagram' },
  ];

  return (
    <div className="container-fluid bg-light p-0">
      <div className="row gx-0 d-none d-lg-flex">
        <div className="col-lg-7 px-5 text-start">
          <div className="h-100 d-inline-flex align-items-center py-3 me-4">
            <small>{t('topbar.tagline')}</small>
          </div>
        </div>
        <div className="col-lg-5 px-5 text-end">
          <div className="h-100 d-inline-flex align-items-center">
            <ul className="navbar-nav" />
            {socialLinks.map((link) => (
              <a key={link.href} className="btn btn-sm-square bg-white text-primary me-1" href={link.href}>
                <i className={link.icon} />
              </a>
            ))}
          </div>
        </div>
      </div>
    </div>
  );
};

export default Topbar;



