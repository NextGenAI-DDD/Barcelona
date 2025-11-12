import React from 'react';
import { createRoot } from 'react-dom/client';
import './app.js';

const Home = () => (
  <section className="carousel">
    <div className="container-fluid p-0 mb-5">
      <div id="header-carousel" className="carousel slide" data-bs-ride="carousel">
        <div className="carousel-inner">
          <div className="carousel-item active">
            <img className="w-100" src="/storage/img/stadion.jpg" alt="Stadion" />
          </div>
        </div>
      </div>
    </div>
  </section>
);

const rootElement = document.getElementById('app');

if (rootElement) {
  const root = createRoot(rootElement);
  root.render(<Home />);
}

