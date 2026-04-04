/**
 * @license
 * SPDX-License-Identifier: Apache-2.0
 */

import { 
  LayoutGrid, 
  Palette, 
  Code, 
  TrendingUp, 
  Search, 
  PieChart, 
  Rocket, 
  Send, 
  Facebook, 
  Twitter, 
  Instagram, 
  Youtube, 
  ArrowUp 
} from 'lucide-react';
import { motion } from 'motion/react';

const Header = () => (
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

const Hero = () => (
  <section className="px-6 pt-0 pb-24 max-w-7xl mx-auto w-full">
    <motion.div 
      initial={{ opacity: 0, y: 20 }}
      whileInView={{ opacity: 1, y: 0 }}
      viewport={{ once: true }}
      transition={{ duration: 0.8 }}
      className="grid grid-cols-1 md:grid-cols-2 gap-12 items-center bg-[#F2F1ED] p-12 md:p-20 rounded-sm"
    >
      <div>
        <h2 className="text-5xl md:text-7xl font-bold tracking-tighter mb-8 leading-tight">
          Let's Create Something Great
        </h2>
        <button className="bg-[#4A76B2] text-white px-10 py-4 rounded-sm text-sm font-bold tracking-widest uppercase hover:bg-opacity-90 transition-all shadow-lg">
          LET'S TALK WITH US
        </button>
      </div>
      <div>
        <p className="text-xl text-gray-600 leading-relaxed">
          We are a digital agency that helps build immersive and engaging user experiences that drive results. Our team of experts is dedicated to pushing the boundaries of what's possible in the digital space.
        </p>
      </div>
    </motion.div>
  </section>
);

const ServiceCard = ({ icon: Icon, title, description, items }: any) => (
  <div className="flex flex-col gap-6 p-8 bg-white rounded-sm border border-gray-100 hover:border-[#4A76B2] transition-colors group">
    <div className="flex-shrink-0">
      <div className="w-16 h-16 bg-[#F2F1ED] rounded-lg flex items-center justify-center group-hover:bg-[#4A76B2] transition-colors">
        <Icon className="w-8 h-8 text-black group-hover:text-white transition-colors" />
      </div>
    </div>
    <div className="flex-grow">
      <h3 className="text-2xl font-bold mb-3">{title}</h3>
      <p className="text-gray-600 mb-6 leading-relaxed">
        {description}
      </p>
      <ul className="grid grid-cols-1 gap-y-2">
        {items.map((item: string, i: number) => (
          <li key={i} className="flex items-center text-sm font-medium">
            <span className="w-1.5 h-1.5 bg-black rounded-full mr-3"></span>
            {item}
          </li>
        ))}
      </ul>
    </div>
  </div>
);

const Services = () => (
  <section className="px-6 py-20 max-w-7xl mx-auto w-full">
    <div className="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
      <h2 className="text-5xl md:text-6xl font-bold tracking-tighter">What We Excel At</h2>
      <p className="text-gray-500 max-w-xs text-sm uppercase tracking-widest font-bold">
        Our Specialized Services
      </p>
    </div>
    <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
      <ServiceCard 
        icon={LayoutGrid}
        title="Business Consultancy"
        description="Business consultancy, team skills and engaging user experiences that deliver results."
        items={["Strategic Planning", "Digital Transformation", "Operations Scaling", "Mentorship"]}
      />
      <ServiceCard 
        icon={Palette}
        title="Branding Design"
        description="Branding design for a modern-scale to imitates your customize processing."
        items={["Brand Identity", "Logo Design", "Visual Strategy", "Brand Guidelines"]}
      />
      <ServiceCard 
        icon={Code}
        title="Web Development"
        description="Code and e-commerce development action at your options or intuitive results."
        items={["Custom Websites", "Web Applications", "E-commerce", "Performance Optimization"]}
      />
      <ServiceCard 
        icon={TrendingUp}
        title="Digital Marketing"
        description="Digital marketing streams interesting, salient, meticulous, and digital marketing."
        items={["SEO Optimization", "Social Media Marketing (SMM)", "Content Strategy", "PPC Advertising"]}
      />
    </div>
  </section>
);

const ProcessStep = ({ number, title, description, icon: Icon }: any) => (
  <div className="relative flex flex-col items-start text-left group">
    <div className="mb-6 relative z-10">
      <div className="w-14 h-14 bg-[#F2F1ED] rounded-full flex items-center justify-center group-hover:bg-[#4A76B2] group-hover:text-white transition-colors duration-300">
        <Icon className="w-6 h-6" />
      </div>
    </div>
    <div className="text-xs font-bold text-gray-400 mb-1 uppercase tracking-widest">{number}</div>
    <h3 className="text-xl font-bold mb-3">{title}</h3>
    <p className="text-sm text-gray-500 leading-relaxed max-w-[200px]">
      {description}
    </p>
  </div>
);

const Process = () => (
  <section className="px-6 pt-24 pb-0 max-w-7xl mx-auto w-full">
    <h2 className="text-5xl md:text-6xl font-bold tracking-tighter mb-20">Our Process</h2>
    <div className="relative">
      {/* Connecting Line */}
      <div className="hidden md:block absolute top-7 left-0 w-full h-[1px] bg-gray-200 -z-0"></div>
      
      <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-12 md:gap-8">
        <ProcessStep 
          number="01"
          title="Discovery"
          description="Discovery and make concepts in measures with business needs."
          icon={Search}
        />
        <ProcessStep 
          number="02"
          title="Strategy"
          description="We are a digital agency team, team skills are smarter and engaging user drives experiences."
          icon={PieChart}
        />
        <ProcessStep 
          number="03"
          title="Design"
          description="Design concepts for engagement, meticulous, design, and digital marketing."
          icon={Palette}
        />
        <ProcessStep 
          number="04"
          title="Launch"
          description="Launch for innovative contents and involving, social media, and digital results."
          icon={Rocket}
        />
      </div>
    </div>
  </section>
);

export default function App() {
  return (
    <div className="min-h-screen flex flex-col">
      <Header />
      <main className="flex-grow">
        <Services />
        <Process />
        <Hero />
      </main>
      <Footer />
    </div>
  );
}
