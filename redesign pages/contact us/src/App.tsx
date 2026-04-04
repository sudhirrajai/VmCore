import { Facebook, Twitter, Instagram, Linkedin, ArrowRight, Mail, Phone, MapPin, Youtube } from 'lucide-react';
import { motion } from 'motion/react';
import { useState } from 'react';

const Navbar = () => (
  <nav className="flex items-center justify-between px-6 py-6 max-w-7xl mx-auto w-full">
    <div className="text-2xl font-bold tracking-tighter">VM CORE</div>
    <div className="hidden md:flex items-center space-x-8 text-sm font-medium">
      <a href="#" className="hover:opacity-60 transition-opacity">Home</a>
      <a href="#" className="border-b-2 border-black pb-1">About</a>
      <a href="#" className="hover:opacity-60 transition-opacity">Services</a>
      <a href="#" className="hover:opacity-60 transition-opacity">Portfolio</a>
      <a href="#" className="hover:opacity-60 transition-opacity">FAQ</a>
      <button className="bg-[#4A76B2] text-white px-6 py-2.5 rounded-sm text-xs font-bold tracking-widest uppercase hover:bg-opacity-90 transition-all">
        WORK WITH US
      </button>
    </div>
  </nav>
);

const ContactInfo = () => (
  <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-8 lg:space-y-8">
    <div>
      <h3 className="text-xl font-bold mb-2">Office Address</h3>
      <p className="text-gray-600 leading-relaxed">
        Address, Rissttin Road,<br />
        VMCore, FY 37028
      </p>
    </div>
    <div>
      <h3 className="text-xl font-bold mb-2">Phone</h3>
      <p className="text-gray-600">+1 (285) 335-5200</p>
    </div>
    <div>
      <h3 className="text-xl font-bold mb-2">Email</h3>
      <p className="text-gray-600">wmventl@vmcore.com</p>
    </div>
    <div>
      <h3 className="text-xl font-bold mb-4">Social Media</h3>
      <div className="flex gap-4">
        <a href="#" className="bg-brand-dark text-white p-2 rounded-full hover:bg-brand-blue transition-colors">
          <Facebook size={18} fill="currentColor" />
        </a>
        <a href="#" className="bg-brand-dark text-white p-2 rounded-full hover:bg-brand-blue transition-colors">
          <Twitter size={18} fill="currentColor" />
        </a>
        <a href="#" className="bg-brand-dark text-white p-2 rounded-full hover:bg-brand-blue transition-colors">
          <Instagram size={18} />
        </a>
        <a href="#" className="bg-brand-dark text-white p-2 rounded-full hover:bg-brand-blue transition-colors">
          <Linkedin size={18} fill="currentColor" />
        </a>
      </div>
    </div>
  </div>
);

const ContactForm = () => {
  return (
    <div className="bg-white p-8 rounded-lg shadow-sm border border-gray-100">
      <form className="space-y-6" onSubmit={(e) => e.preventDefault()}>
        <div>
          <label className="block text-sm font-bold mb-2 uppercase tracking-tight">
            Name <span className="text-red-500">*</span>
          </label>
          <input 
            required
            type="text" 
            className="w-full border border-gray-200 p-3 rounded-sm focus:outline-none focus:border-brand-blue transition-colors"
            placeholder="Your full name"
          />
        </div>
        <div>
          <label className="block text-sm font-bold mb-2 uppercase tracking-tight">
            Email <span className="text-red-500">*</span>
          </label>
          <input 
            required
            type="email" 
            className="w-full border border-gray-200 p-3 rounded-sm focus:outline-none focus:border-brand-blue transition-colors"
            placeholder="your@email.com"
          />
        </div>
        <div>
          <label className="block text-sm font-bold mb-2 uppercase tracking-tight">
            Phone No
          </label>
          <input 
            type="tel" 
            className="w-full border border-gray-200 p-3 rounded-sm focus:outline-none focus:border-brand-blue transition-colors"
            placeholder="+1 (000) 000-0000"
          />
        </div>
        <div>
          <label className="block text-sm font-bold mb-2 uppercase tracking-tight">
            Subject <span className="text-red-500">*</span>
          </label>
          <input 
            required
            type="text" 
            className="w-full border border-gray-200 p-3 rounded-sm focus:outline-none focus:border-brand-blue transition-colors"
            placeholder="What is this regarding?"
          />
        </div>
        <div>
          <label className="block text-sm font-bold mb-2 uppercase tracking-tight">
            Message <span className="text-red-500">*</span>
          </label>
          <textarea 
            required
            rows={4}
            className="w-full border border-gray-200 p-3 rounded-sm focus:outline-none focus:border-brand-blue transition-colors resize-none"
            placeholder="Tell us more about your project..."
          />
        </div>
        <button className="w-full bg-brand-blue text-white py-4 rounded-sm font-bold uppercase tracking-widest hover:bg-opacity-90 transition-all shadow-md">
          Send Message
        </button>
      </form>
    </div>
  );
};

const MapSection = () => (
  <div className="max-w-7xl mx-auto px-6 my-20">
    <div className="relative w-full h-[500px] rounded-lg overflow-hidden border border-gray-200 shadow-sm">
      {/* Mock Map Background */}
      <div 
        className="absolute inset-0 bg-cover bg-center grayscale-[0.5] opacity-80"
        style={{ backgroundImage: 'url("https://images.unsplash.com/photo-1526778548025-fa2f459cd5c1?auto=format&fit=crop&q=80&w=2000")' }}
      />
      
      {/* Map Overlay UI */}
      <div className="absolute top-4 left-4 flex bg-white rounded-sm shadow-md overflow-hidden text-xs font-bold uppercase">
        <button className="px-4 py-2 bg-white border-r border-gray-100 hover:bg-gray-50">Map</button>
        <button className="px-4 py-2 bg-gray-50 text-gray-400 hover:bg-gray-100">Satellite</button>
      </div>
      
      <div className="absolute top-4 right-4 bg-white p-2 rounded-sm shadow-md">
        <div className="w-6 h-6 flex items-center justify-center text-gray-600">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="w-4 h-4"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
        </div>
      </div>

      {/* Map Marker */}
      <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center">
        <div className="bg-white px-4 py-2 rounded-sm shadow-xl border border-gray-100 mb-2 whitespace-nowrap">
          <p className="text-xs font-bold">A05, Risetin Road.</p>
          <p className="text-[10px] text-gray-500">VMCore, FY 37028</p>
        </div>
        <div className="w-8 h-8 bg-brand-dark rounded-full flex items-center justify-center shadow-lg border-2 border-white">
          <MapPin size={16} className="text-white" />
        </div>
      </div>

      {/* Map Controls */}
      <div className="absolute bottom-10 right-4 flex flex-col gap-1">
        <button className="w-8 h-8 bg-white flex items-center justify-center shadow-md rounded-sm text-xl font-light">+</button>
        <button className="w-8 h-8 bg-white flex items-center justify-center shadow-md rounded-sm text-xl font-light">−</button>
      </div>
      
      <div className="absolute bottom-4 left-4">
        <span className="text-sm font-bold text-gray-400 italic">Google</span>
      </div>
      
      <div className="absolute bottom-4 right-20 text-[10px] text-gray-500 bg-white/80 px-2 py-0.5 rounded-sm">
        Map data ©2026 Google Terms of Use
      </div>
    </div>
  </div>
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
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="lucide lucide-send w-6 h-6" aria-hidden="true">
                <path d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z"></path>
                <path d="m21.854 2.147-10.94 10.939"></path>
              </svg>
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
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="lucide lucide-facebook w-5 h-5 cursor-pointer hover:opacity-60" aria-hidden="true">
              <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="lucide lucide-twitter w-5 h-5 cursor-pointer hover:opacity-60" aria-hidden="true">
              <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="lucide lucide-instagram w-5 h-5 cursor-pointer hover:opacity-60" aria-hidden="true">
              <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
              <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
              <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="lucide lucide-youtube w-5 h-5 cursor-pointer hover:opacity-60" aria-hidden="true">
              <path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"></path>
              <path d="m10 15 5-3-5-3z"></path>
            </svg>
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
        <button className="w-10 h-10 bg-white rounded-sm flex items-center justify-center shadow-sm hover:shadow-md transition-shadow">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="lucide lucide-arrow-up w-4 h-4" aria-hidden="true">
            <path d="m5 12 7-7 7 7"></path>
            <path d="M12 19V5"></path>
          </svg>
        </button>
      </div>
    </div>
  </footer>
);

export default function App() {
  return (
    <div className="min-h-screen flex flex-col">
      <Navbar />
      
      <main className="flex-grow">
        <section className="max-w-7xl mx-auto px-6 py-20">
          <motion.h1 
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            className="text-5xl md:text-6xl font-bold tracking-tight mb-20"
          >
            Let's Start a Conversation
          </motion.h1>

          <div className="grid grid-cols-1 lg:grid-cols-2 gap-20 items-start">
            <motion.div
              initial={{ opacity: 0, x: -20 }}
              animate={{ opacity: 1, x: 0 }}
              transition={{ delay: 0.2 }}
            >
              <ContactInfo />
            </motion.div>
            
            <motion.div
              initial={{ opacity: 0, x: 20 }}
              animate={{ opacity: 1, x: 0 }}
              transition={{ delay: 0.3 }}
            >
              <ContactForm />
            </motion.div>
          </div>
        </section>

        <MapSection />
      </main>

      <Footer />
    </div>
  );
}
