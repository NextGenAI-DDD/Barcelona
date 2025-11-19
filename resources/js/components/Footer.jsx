import React from 'react';
import { useTranslation } from 'react-i18next';

const Footer = () => {
  const { t } = useTranslation();
  const socialLinks = [
    { href: 'https://twitter.com/FCBarcelona', icon: 'fab fa-twitter' },
    {
      href: 'https://www.facebook.com/fcbarcelona/?locale2=pl_PL&paipv=0&eav=Afb2n5L1Tx-Mt3jgHGiTtzg09mMnoV8wj5UVSwcpIQZsAUtkFcYDSZy7hChMuobcaro&_rdr',
      icon: 'fab fa-facebook-f',
    },
    { href: 'https://www.youtube.com/@FCBarcelona', icon: 'fab fa-youtube' },
    { href: 'https://www.linkedin.com/in/adrian-kemski-7840b1251/', icon: 'fab fa-linkedin-in' },
  ];

  return (
    <div className="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s" id="footer">
      <div className="container py-5">
        <div className="row g-5">
          <div className="col-lg-4">
            <h4 className="text-light mb-4">{t('footer.contactHeading')}</h4>
            <p className="mb-2">
              <i className="fa fa-envelope me-3" />
              barcelona.info@gmail.com
            </p>
          </div>
          <div className="col-lg-4">
            <h4 className="text-light mb-4">{t('footer.communityHeading')}</h4>
            <div className="d-flex pt-2">
              {socialLinks.map((link) => (
                <a key={link.href} className="btn btn-outline-light btn-social" href={link.href}>
                  <i className={link.icon} />
                </a>
              ))}
            </div>
          </div>
        </div>
      </div>
      <div className="container">
        <div className="copyright">
          <div className="row">
            <div className="col-md-6 text-center text-md-start mb-3 mb-md-0">
              &copy;{' '}
              <a className="border-bottom" href="#">
                Barcelona Fun Club
              </a>
              , {t('footer.rightsReserved')}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Footer;



