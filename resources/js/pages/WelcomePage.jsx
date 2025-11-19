import React from 'react';
import { useTranslation } from 'react-i18next';

const WelcomePage = () => {
  const { t } = useTranslation();

  return (
    <section className="carousel">
      <div className="container-fluid p-0 mb-5">
        <div id="header-carousel" className="carousel slide" data-bs-ride="carousel">
          <div className="carousel-inner">
            <div className="carousel-item active">
              <img className="w-100" src="/storage/img/stadion.jpg" alt={t('welcome.carouselAlt')} />
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default WelcomePage;


