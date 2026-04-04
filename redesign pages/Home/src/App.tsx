/**
 * @license
 * SPDX-License-Identifier: Apache-2.0
 */

import React, { useState } from 'react';
import { 
  LayoutGrid, 
  Palette, 
  Code2, 
  TrendingUp, 
  ArrowRight, 
  ArrowUpRight,
  Facebook,
  Twitter,
  Instagram,
  Youtube,
  ArrowUp,
  BarChart3,
  Send
} from 'lucide-react';
import { motion } from 'motion/react';

const Navbar = () => {
  const [active, setActive] = useState('Home');

  return (
    <nav className="flex items-center justify-between px-6 py-6 max-w-7xl mx-auto w-full bg-transparent">
      <div className="text-2xl font-bold tracking-tighter text-slate-900">
        VM CORE
      </div>
      
      <div className="hidden md:flex items-center space-x-8 text-sm font-medium">
        {['Home', 'About', 'Services', 'Portfolio', 'FAQ'].map((item) => (
          <a 
            key={item} 
            href={`#${item.toLowerCase()}`} 
            onClick={(e) => {
              e.preventDefault();
              setActive(item);
            }}
            className={`transition-all ${
              active === item 
                ? 'border-b-2 border-black pb-1 text-slate-900' 
                : 'text-slate-800 hover:opacity-60 transition-opacity'
            }`}
          >
            {item}
          </a>
        ))}
        <button className="bg-[#4A76B2] text-white px-6 py-2.5 rounded-sm text-xs font-bold tracking-widest uppercase hover:bg-opacity-90 transition-all">
          WORK WITH US
        </button>
      </div>
    </nav>
  );
};

const Hero = () => (
  <section className="pt-0 pb-12">
    <div className="container-custom grid md:grid-cols-2 gap-12 items-center">
      <motion.div 
        initial={{ opacity: 0, x: -20 }}
        animate={{ opacity: 1, x: 0 }}
        transition={{ duration: 0.6 }}
      >
        <h1 className="text-5xl md:text-7xl font-bold leading-[1.1] text-slate-900 mb-6">
          WE MAKE <br />
          CREATIVE THINGS <br />
          EVERYDAY
        </h1>
        <p className="text-lg text-slate-600 mb-8 max-w-md leading-relaxed">
          We are a digital agency that helps build immersive and engaging user experiences that drive results.
        </p>
        <button className="bg-[#4E7CC1] text-white px-8 py-4 rounded-md font-semibold flex items-center gap-2 hover:bg-[#3d66a3] transition-all shadow-md">
          VIEW OUR WORKS
        </button>
      </motion.div>
      <motion.div 
        initial={{ opacity: 0, scale: 0.95 }}
        animate={{ opacity: 1, scale: 1 }}
        transition={{ duration: 0.6, delay: 0.2 }}
        className="relative"
      >
        <img 
          src="https://picsum.photos/seed/vmcore-meeting/800/600" 
          alt="Team Meeting" 
          className="rounded-3xl shadow-2xl w-full object-cover aspect-[4/3]"
          referrerPolicy="no-referrer"
        />
      </motion.div>
    </div>
  </section>
);

const Services = () => {
  const services = [
    {
      title: "Business Consultancy",
      description: "Business consultancy, team skills and engaging user experiences that delete results.",
      icon: (
        <div className="grid grid-cols-2 gap-1 w-6 h-6">
          <div className="border-2 border-slate-900 rounded-sm"></div>
          <div className="border-2 border-slate-900 rounded-full"></div>
          <div className="border-2 border-slate-900 rounded-sm"></div>
          <div className="border-2 border-slate-900 rounded-sm"></div>
        </div>
      ),
      color: "bg-[#F7F7F2]"
    },
    {
      title: "Branding Design",
      description: "Branding design for small-scale to limiters your customize processing.",
      icon: <Palette className="w-7 h-7 text-slate-900" strokeWidth={1.5} />,
      color: "bg-[#F7F7F2]"
    },
    {
      title: "Web Development",
      description: "Code and components development action at your options or active results.",
      icon: <Code2 className="w-7 h-7 text-slate-900" strokeWidth={1.5} />,
      color: "bg-[#F7F7F2]"
    },
    {
      title: "Digital Marketing",
      description: "Digital marketing streams with instant, salient, monitoring, and digital marketing.",
      icon: <BarChart3 className="w-7 h-7 text-slate-900" strokeWidth={1.5} />,
      color: "bg-[#F7F7F2]"
    }
  ];

  return (
    <section id="services" className="py-12">
      <div className="container-custom">
        <div className="mb-14">
          <span className="text-[15px] font-medium text-slate-600 mb-3 block">Services</span>
          <h2 className="text-[44px] font-bold text-slate-900 leading-tight tracking-tight">What We Can Do for Our Clients</h2>
        </div>
        <div className="grid md:grid-cols-2 gap-8">
          {services.map((service, index) => (
            <motion.div 
              key={index}
              whileHover={{ y: -4 }}
              className="bg-white p-10 rounded-2xl border border-slate-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] flex gap-8 items-start group cursor-pointer"
            >
              <div className={`${service.color} p-6 rounded-2xl group-hover:bg-slate-100 transition-colors flex-shrink-0`}>
                {service.icon}
              </div>
              <div className="pt-2">
                <h3 className="text-[22px] font-bold text-slate-900 mb-3">{service.title}</h3>
                <p className="text-slate-500 text-[15px] mb-5 leading-relaxed max-w-[340px]">{service.description}</p>
                <div className="flex items-center gap-1.5 text-[13px] font-bold uppercase tracking-wider text-slate-900 group-hover:text-[#4E7CC1] transition-colors">
                  VIEW DETAILS <ArrowUpRight className="w-4 h-4" />
                </div>
              </div>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
};

const Projects = () => {
  const projects = [
    {
      title: "Clotheeo | Crafted for You",
      category: "Fashion",
      image: "https://picsum.photos/seed/fashion-project/600/800"
    },
    {
      title: "Greenlife",
      category: "Sustainability",
      image: "https://picsum.photos/seed/green-project/600/800"
    },
    {
      title: "TechWave",
      category: "Technology",
      image: "https://picsum.photos/seed/tech-project/600/800"
    }
  ];

  return (
    <section id="portfolio" className="py-12">
      <div className="container-custom">
        <div className="mb-12">
          <span className="text-sm font-semibold text-slate-500 uppercase tracking-wider">Projects</span>
          <h2 className="text-4xl font-bold text-slate-900 mt-2">Discover Our Selected Projects</h2>
        </div>
        <div className="grid md:grid-cols-3 gap-8">
          {projects.map((project, index) => (
            <motion.div 
              key={index}
              whileHover={{ scale: 1.02 }}
              className="relative group rounded-2xl overflow-hidden cursor-pointer aspect-[3/4]"
            >
              <img 
                src={project.image} 
                alt={project.title} 
                className="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                referrerPolicy="no-referrer"
              />
              <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex flex-col justify-end p-8">
                <div className="flex items-center justify-between">
                  <h3 className="text-white font-bold text-xl">{project.title}</h3>
                  <div className="bg-white/20 backdrop-blur-md p-2 rounded-full text-white">
                    <ArrowRight className="w-5 h-5" />
                  </div>
                </div>
              </div>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
};

const Clients = () => {
  const logos = [
    <div key="1" className="text-4xl font-black tracking-tighter">Z</div>,
    <div key="2" className="text-4xl font-black tracking-tighter">C</div>,
    <div key="3" className="text-2xl font-bold uppercase tracking-[0.2em]">CLOTHEEO</div>,
    <div key="4" className="text-3xl font-serif font-bold italic">Smriti</div>,
    <div key="5" className="text-4xl font-black tracking-tighter">V</div>,
    <div key="6" className="text-2xl font-bold uppercase tracking-[0.2em]">TECHWAVE</div>,
  ];

  return (
    <section className="py-12 border-y border-slate-100 overflow-hidden bg-white/50">
      <div className="relative flex overflow-hidden">
        <motion.div
          animate={{ x: ["0%", "-50%"] }}
          transition={{
            duration: 30,
            ease: "linear",
            repeat: Infinity,
          }}
          className="flex gap-20 items-center whitespace-nowrap opacity-40 grayscale hover:grayscale-0 transition-all"
        >
          {[...logos, ...logos, ...logos].map((logo, index) => (
            <div key={index} className="flex-shrink-0 px-4">
              {logo}
            </div>
          ))}
        </motion.div>
      </div>
    </section>
  );
};

const CTA = () => (
  <section className="px-6 py-24 max-w-7xl mx-auto w-full">
    <motion.div
      initial={{ opacity: 0, y: 20 }}
      whileInView={{ opacity: 1, y: 0 }}
      viewport={{ once: true }}
      transition={{ duration: 0.6 }}
      className="grid grid-cols-1 md:grid-cols-2 gap-12 items-center bg-[#F2F1ED] p-12 md:p-20 rounded-sm"
    >
      <div>
        <h2 className="text-5xl md:text-7xl font-bold tracking-tighter mb-8 leading-tight text-slate-900">
          Let's Create Something Great
        </h2>
        <button className="bg-black text-white px-10 py-4 rounded-sm text-sm font-bold tracking-widest uppercase hover:bg-opacity-90 transition-all shadow-lg">
          LET'S TALK WITH US
        </button>
      </div>
      <div>
        <p className="text-xl text-slate-600 leading-relaxed">
          We are a digital agency that helps build immersive and engaging user experiences that drive results. Our team of experts is dedicated to pushing the boundaries of what's possible in the digital space.
        </p>
      </div>
    </motion.div>
  </section>
);

const Footer = () => (
  <footer className="bg-[#F2F1ED] py-12 px-6">
    <div className="max-w-7xl mx-auto w-full">
      <div className="grid grid-cols-1 md:grid-cols-12 gap-12 mb-12">
        <div className="col-span-1 md:col-span-5">
          <h4 className="font-bold text-base uppercase tracking-widest mb-6">Newsletter Subscription</h4>
          <div className="relative">
            <input 
              placeholder="Your email here" 
              className="w-full bg-white border-none px-6 py-5 pr-16 rounded-sm text-lg focus:ring-1 focus:ring-[#4A76B2] outline-none" 
              type="email" 
            />
            <button className="absolute right-6 top-1/2 -translate-y-1/2 text-gray-400 hover:text-black">
              <Send className="w-6 h-6" />
            </button>
          </div>
          <p className="text-sm text-gray-400 mt-4 leading-relaxed">
            You can unsubscribe at any time and your data is protected by our privacy policy.
          </p>
        </div>
        
        <div className="md:col-span-2">
          <h4 className="font-bold text-sm uppercase tracking-widest mb-4">Links</h4>
          <ul className="space-y-2 text-base text-gray-600">
            <li><a href="#" className="hover:text-black">Home</a></li>
            <li><a href="#" className="hover:text-black">About</a></li>
            <li><a href="#" className="hover:text-black">Services</a></li>
            <li><a href="#" className="hover:text-black">Portfolio</a></li>
            <li><a href="#" className="hover:text-black">FAQ</a></li>
          </ul>
        </div>

        <div className="md:col-span-2">
          <h4 className="font-bold text-sm uppercase tracking-widest mb-4">Services</h4>
          <ul className="space-y-2 text-base text-gray-600">
            <li><a href="#" className="hover:text-black">Branding</a></li>
            <li><a href="#" className="hover:text-black">Graphic Design</a></li>
            <li><a href="#" className="hover:text-black">Web Development</a></li>
            <li><a href="#" className="hover:text-black">Contact</a></li>
          </ul>
        </div>

        <div className="md:col-span-3">
          <h4 className="font-bold text-sm uppercase tracking-widest mb-4">Contact</h4>
          <div className="flex space-x-4 mb-4">
            <Facebook className="w-5 h-5 cursor-pointer hover:opacity-60" />
            <Twitter className="w-5 h-5 cursor-pointer hover:opacity-60" />
            <Instagram className="w-5 h-5 cursor-pointer hover:opacity-60" />
            <Youtube className="w-5 h-5 cursor-pointer hover:opacity-60" />
          </div>
          <address className="not-italic text-base text-gray-600 space-y-1">
            <p>Address: Risstih Road, VelCore, FY 37028</p>
            <p className="mt-2">Support information</p>
            <p className="font-medium text-black">wmvent@vmcore.com</p>
          </address>
        </div>
      </div>
      
      <div className="pt-8 border-t border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4">
        <p className="text-sm text-gray-500">Copyright © 2026 VM CORE</p>
        <button 
          onClick={() => window.scrollTo({ top: 0, behavior: 'smooth' })}
          className="w-10 h-10 bg-white rounded-sm flex items-center justify-center shadow-sm hover:shadow-md transition-shadow"
        >
          <ArrowUp className="w-4 h-4" />
        </button>
      </div>
    </div>
  </footer>
);

export default function App() {
  return (
    <div className="min-h-screen selection:bg-[#4E7CC1]/30">
      <Navbar />
      <main>
        <Hero />
        <Services />
        <Projects />
        <Clients />
        <CTA />
      </main>
      <Footer />
    </div>
  );
}
