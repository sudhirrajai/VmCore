/**
 * @license
 * SPDX-License-Identifier: Apache-2.0
 */

import { motion } from "motion/react";
import { 
  ArrowUp, 
  ChevronRight, 
  Lightbulb, 
  Handshake, 
  ArrowUpCircle, 
  Facebook, 
  Twitter, 
  Instagram, 
  Youtube,
  Send
} from "lucide-react";

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

const Hero = () => (
  <section className="px-6 pb-12 pt-0 max-w-7xl mx-auto w-full grid md:grid-cols-2 gap-12 items-center">
    <motion.div 
      initial={{ opacity: 0, x: -20 }}
      whileInView={{ opacity: 1, x: 0 }}
      viewport={{ once: true }}
      transition={{ duration: 0.6 }}
    >
      <h1 className="text-6xl md:text-8xl font-bold tracking-tighter mb-8">Our Story</h1>
      <p className="text-lg text-gray-700 leading-relaxed max-w-lg">
        We are a digital agency dedicated to driving digital transformation, building immersive experiences that empower businesses and connect with audiences. Our passion is innovation, and our mission is your success.
      </p>
    </motion.div>
    <motion.div
      initial={{ opacity: 0, scale: 0.95 }}
      whileInView={{ opacity: 1, scale: 1 }}
      viewport={{ once: true }}
      transition={{ duration: 0.8 }}
      className="relative aspect-[4/3] rounded-2xl overflow-hidden shadow-2xl"
    >
      <img 
        src="https://picsum.photos/seed/agency-team-office/1200/900" 
        alt="Team working together" 
        className="object-cover w-full h-full grayscale-[0.2] hover:scale-105 transition-transform duration-700"
        referrerPolicy="no-referrer"
      />
    </motion.div>
  </section>
);

const Leadership = () => {
  const leaders = [
    { name: "Alex Chen", role: "CEO & Founder", img: "https://picsum.photos/seed/alex-chen-portrait/600/800" },
    { name: "Sarah Johnson", role: "Head of Strategy", img: "https://picsum.photos/seed/sarah-johnson-portrait/600/800" },
    { name: "David Lee", role: "Creative Director", img: "https://picsum.photos/seed/david-lee-portrait/600/800" }
  ];

  return (
    <section className="px-6 py-12 max-w-7xl mx-auto w-full">
      <div className="mb-12">
        <span className="text-sm font-medium text-gray-500 uppercase tracking-widest">Our Leadership</span>
        <h2 className="text-5xl font-bold tracking-tighter mt-2">Our Leadership</h2>
      </div>
      <div className="grid md:grid-cols-3 gap-8">
        {leaders.map((leader, idx) => (
          <motion.div 
            key={idx}
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            transition={{ delay: idx * 0.1, duration: 0.5 }}
            className="group"
          >
            <div className="aspect-[3/4] rounded-xl overflow-hidden mb-6 bg-gray-100">
              <img 
                src={leader.img} 
                alt={leader.name} 
                className="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500"
                referrerPolicy="no-referrer"
              />
            </div>
            <h3 className="text-2xl font-bold tracking-tight">{leader.name}</h3>
            <p className="text-gray-500 text-sm mt-1">{leader.role}</p>
          </motion.div>
        ))}
      </div>
    </section>
  );
};

const CoreValues = () => {
  const values = [
    { 
      title: "Innovation", 
      desc: "Innovation, innovation experiences and materials for new horizons.", 
      icon: <Lightbulb className="w-8 h-8 stroke-[1.5]" /> 
    },
    { 
      title: "Integrity", 
      desc: "Integrity consulting in maturity and strategic in technology.", 
      icon: <Handshake className="w-8 h-8 stroke-[1.5]" /> 
    },
    { 
      title: "Impact", 
      desc: "Impact consider that on chat radiant and empower the reflection.", 
      icon: <ArrowUpCircle className="w-8 h-8 stroke-[1.5]" /> 
    }
  ];

  return (
    <section className="px-6 py-12 max-w-7xl mx-auto w-full">
      <div className="mb-12">
        <span className="text-sm font-medium text-gray-500 uppercase tracking-widest">Core Values</span>
        <h2 className="text-5xl font-bold tracking-tighter mt-2">Core Values</h2>
      </div>
      <div className="grid md:grid-cols-3 gap-6">
        {values.map((value, idx) => (
          <motion.div 
            key={idx}
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            transition={{ delay: idx * 0.1, duration: 0.5 }}
            className="bg-white p-10 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow"
          >
            <div className="w-16 h-16 bg-[#F5F4F0] rounded-xl flex items-center justify-center mb-8">
              {value.icon}
            </div>
            <h3 className="text-2xl font-bold tracking-tight mb-4">{value.title}</h3>
            <p className="text-gray-500 text-sm leading-relaxed">{value.desc}</p>
          </motion.div>
        ))}
      </div>
    </section>
  );
};

const Stats = () => (
  <section className="px-6 py-12 max-w-7xl mx-auto w-full grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
    <motion.div
      initial={{ opacity: 0, scale: 0.9 }}
      whileInView={{ opacity: 1, scale: 1 }}
      viewport={{ once: true }}
    >
      <div className="text-7xl font-bold tracking-tighter mb-2">50+</div>
      <div className="text-lg font-medium text-gray-600">Projects Delivered</div>
    </motion.div>
    <motion.div
      initial={{ opacity: 0, scale: 0.9 }}
      whileInView={{ opacity: 1, scale: 1 }}
      viewport={{ once: true }}
      transition={{ delay: 0.1 }}
    >
      <div className="text-7xl font-bold tracking-tighter mb-2">5+</div>
      <div className="text-lg font-medium text-gray-600">Years of Experience</div>
    </motion.div>
    <motion.div
      initial={{ opacity: 0, scale: 0.9 }}
      whileInView={{ opacity: 1, scale: 1 }}
      viewport={{ once: true }}
      transition={{ delay: 0.2 }}
    >
      <div className="text-7xl font-bold tracking-tighter mb-2">98%</div>
      <div className="text-lg font-medium text-gray-600">Client Satisfaction</div>
    </motion.div>
  </section>
);

const CTA = () => (
  <section className="px-6 py-12 max-w-7xl mx-auto w-full">
    <motion.div
      initial={{ opacity: 0, y: 20 }}
      whileInView={{ opacity: 1, y: 0 }}
      viewport={{ once: true }}
      className="grid grid-cols-1 md:grid-cols-2 gap-12 items-center bg-[#F2F1ED] p-12 md:p-20 rounded-sm"
    >
      <div>
        <h2 className="text-5xl md:text-7xl font-bold tracking-tighter mb-8 leading-tight">
          Let's Create Something Great
        </h2>
        <button className="bg-black text-white px-10 py-4 rounded-sm text-sm font-bold tracking-widest uppercase hover:bg-opacity-90 transition-all shadow-lg">
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
    <div className="min-h-screen bg-[#F9F8F4] text-[#141414] font-sans selection:bg-[#4A76B2] selection:text-white">
      <Navbar />
      <main>
        <Hero />
        <Leadership />
        <CoreValues />
        <Stats />
        <CTA />
      </main>
      <Footer />
    </div>
  );
}
