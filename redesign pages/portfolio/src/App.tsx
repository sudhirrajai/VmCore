import { useState } from 'react';
import { motion, AnimatePresence } from 'motion/react';
import { 
  ArrowRight, 
  Facebook, 
  Twitter, 
  Instagram, 
  Youtube,
  ChevronUp,
  Send,
  ArrowUp
} from 'lucide-react';

// --- Types ---

type Category = 'All' | 'Branding' | 'Web Development' | 'Digital Marketing' | 'UI/UX Design' | 'App Dev' | 'Business Consultancy';

interface Project {
  id: number;
  title: string;
  subtitle: string;
  categories: Category[];
  image: string;
}

// --- Data ---

const PROJECTS: Project[] = [
  {
    id: 1,
    title: "Clotheeo | Crafted for You",
    subtitle: "Branding, Web Development",
    categories: ["Branding", "Web Development"],
    image: "https://images.unsplash.com/photo-1539109132382-381bb3f1cff6?auto=format&fit=crop&q=80&w=800&h=600"
  },
  {
    id: 2,
    title: "Smriti | Eco-Friendly Products",
    subtitle: "Web Development, Digital Marketing",
    categories: ["Web Development", "Digital Marketing"],
    image: "https://images.unsplash.com/photo-1605600611284-195205ef91b1?auto=format&fit=crop&q=80&w=800&h=600"
  },
  {
    id: 3,
    title: "Greenlife | Sustainable Living",
    subtitle: "Branding, UI/UX Design",
    categories: ["Branding", "UI/UX Design"],
    image: "https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=800&h=600"
  },
  {
    id: 4,
    title: "TechWave | Future of Work",
    subtitle: "Business Consultancy",
    categories: ["Business Consultancy"],
    image: "https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&q=80&w=800&h=600"
  },
  {
    id: 5,
    title: "FinFlow | Smart Banking",
    subtitle: "UI/UX Design, App Dev",
    categories: ["UI/UX Design", "App Dev"],
    image: "https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&q=80&w=800&h=600"
  },
  {
    id: 6,
    title: "Aura | Minimalist Fashion",
    subtitle: "Web Development, Branding",
    categories: ["Web Development", "Branding"],
    image: "https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&q=80&w=800&h=600"
  }
];

const CATEGORIES: Category[] = ['All', 'Branding', 'Web Development', 'Digital Marketing', 'UI/UX Design'];

// --- Components ---

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

const ProjectCard = ({ project }: { project: Project }) => {
  const [isHovered, setIsHovered] = useState(false);

  return (
    <div 
      className="group cursor-pointer"
      onMouseEnter={() => setIsHovered(true)}
      onMouseLeave={() => setIsHovered(false)}
    >
      <div className="relative aspect-[4/3] overflow-hidden rounded-lg bg-gray-200">
        <img 
          src={project.image} 
          alt={project.title}
          className="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
          referrerPolicy="no-referrer"
        />
        <AnimatePresence>
          {isHovered && (
            <motion.div 
              initial={{ opacity: 0 }}
              animate={{ opacity: 1 }}
              exit={{ opacity: 0 }}
              className="absolute inset-0 bg-black/40 flex items-center justify-center"
            >
              <button className="bg-white text-brand-dark px-6 py-2 rounded-md text-sm font-bold shadow-lg transform translate-y-0 group-hover:-translate-y-2 transition-transform">
                View Project
              </button>
            </motion.div>
          )}
        </AnimatePresence>
      </div>
      <div className="mt-4">
        <h3 className="text-lg font-bold text-gray-900">{project.title}</h3>
        <p className="text-sm text-gray-500 mt-1">{project.subtitle}</p>
      </div>
    </div>
  );
};

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
  const [activeFilter, setActiveFilter] = useState<Category>('All');

  const filteredProjects = PROJECTS.filter(project => 
    activeFilter === 'All' || project.categories.includes(activeFilter)
  );

  return (
    <div className="min-h-screen flex flex-col">
      <Navbar />

      <main className="flex-grow">
        {/* Hero Section */}
        <section className="pt-20 pb-12 px-8 text-center max-w-4xl mx-auto">
          <h1 className="text-5xl font-bold tracking-tight text-gray-900 mb-6">
            Our Impactful Work
          </h1>
          <p className="text-lg text-gray-500 leading-relaxed">
            We partner with forward-thinking companies to craft digital experiences that drive growth and innovation.
          </p>
        </section>

        {/* Filter Section */}
        <section className="px-8 pb-12">
          <div className="flex flex-wrap justify-center gap-3">
            {CATEGORIES.map((category) => (
              <button
                key={category}
                onClick={() => setActiveFilter(category)}
                className={`px-6 py-2 rounded-md text-sm font-medium transition-all duration-200 ${
                  activeFilter === category 
                    ? 'bg-brand-dark text-white shadow-md' 
                    : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200'
                }`}
              >
                {category}
              </button>
            ))}
          </div>
        </section>

        {/* Portfolio Grid */}
        <section className="px-8 pb-24 max-w-7xl mx-auto w-full">
          <motion.div 
            layout
            className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12"
          >
            <AnimatePresence mode="popLayout">
              {filteredProjects.map((project) => (
                <motion.div
                  key={project.id}
                  layout
                  initial={{ opacity: 0, scale: 0.9 }}
                  animate={{ opacity: 1, scale: 1 }}
                  exit={{ opacity: 0, scale: 0.9 }}
                  transition={{ duration: 0.3 }}
                >
                  <ProjectCard project={project} />
                </motion.div>
              ))}
            </AnimatePresence>
          </motion.div>
        </section>

        {/* CTA Section */}
        <section className="px-6 pt-0 pb-24 max-w-7xl mx-auto w-full">
          <motion.div 
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.6 }}
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
      </main>

      <Footer />
    </div>
  );
}
