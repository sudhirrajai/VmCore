import { motion } from "motion/react";
import { 
  Scissors, 
  Ruler, 
  Palette, 
  Shirt,
  Smartphone,
  Monitor,
  Tablet
} from "lucide-react";

const Hero = () => {
  return (
    <section className="py-20 overflow-hidden">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex flex-col items-center text-center mb-16">
          <motion.h1 
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6 }}
            className="text-6xl md:text-8xl font-serif mb-4"
          >
            Clothéeo
          </motion.h1>
          <motion.p 
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6, delay: 0.2 }}
            className="text-xl md:text-2xl font-serif italic text-brand-gold"
          >
            Crafted for You
          </motion.p>
        </div>

        <motion.div 
          initial={{ opacity: 0, scale: 0.95 }}
          animate={{ opacity: 1, scale: 1 }}
          transition={{ duration: 0.8, delay: 0.4 }}
          className="relative max-w-5xl mx-auto"
        >
          <div className="relative z-10 rounded-2xl overflow-hidden shadow-2xl border border-brand-gold/20 bg-white p-4">
            <img 
              src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&q=80&w=2070" 
              alt="Clothéeo Customization Interface" 
              className="w-full rounded-lg"
              referrerPolicy="no-referrer"
            />
          </div>
          <div className="absolute -bottom-10 -right-10 w-64 h-64 bg-brand-gold/10 rounded-full blur-3xl -z-10" />
          <div className="absolute -top-10 -left-10 w-64 h-64 bg-brand-gold/5 rounded-full blur-3xl -z-10" />
        </motion.div>
      </div>
    </section>
  );
};

const Story = () => {
  return (
    <section className="py-24 bg-white">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid md:grid-cols-2 gap-16 items-start">
          <motion.div
            initial={{ opacity: 0, x: -20 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
          >
            <h2 className="text-4xl font-serif mb-8">The Story</h2>
            <p className="text-lg text-brand-muted leading-relaxed mb-6">
              We partnered with Clothéeo, a pioneer in custom fashion, to reimagine their digital experience. The goal was to move beyond standard e-commerce and create a personalized, premium journey where every garment is tailored to the individual. Our approach focused on intuitive design, advanced technology, and ensuring aesthetic to build trust and elevate the brand.
            </p>
          </motion.div>

          <motion.div
            initial={{ opacity: 0, x: 20 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
            className="bg-brand-cream p-8 rounded-2xl border border-brand-gold/10 shadow-sm"
          >
            <h3 className="text-2xl font-serif mb-6">Quick Facts</h3>
            <div className="space-y-4">
              {[
                { label: "Client", value: "Clothéeo" },
                { label: "Industry", value: "E-commerce / Fashion" },
                { label: "Tech", value: "React, Node.js, Three.js" },
                { label: "Services", value: "UI/UX Design, Development" },
              ].map((item, i) => (
                <div key={i} className="flex justify-between border-b border-brand-gold/10 pb-2">
                  <span className="text-sm font-medium text-brand-muted">{item.label}</span>
                  <span className="text-sm font-semibold">{item.value}</span>
                </div>
              ))}
            </div>
          </motion.div>
        </div>
      </div>
    </section>
  );
};

const ProblemSolution = () => {
  return (
    <section className="py-24">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 className="text-4xl font-serif text-center mb-16">Problem & Solution</h2>
        <div className="grid md:grid-cols-2 gap-8">
          <motion.div 
            whileHover={{ y: -5 }}
            className="bg-white p-10 rounded-3xl border border-brand-gold/10 shadow-sm text-center"
          >
            <div className="w-16 h-16 bg-brand-gold/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
              <Shirt className="text-brand-gold" size={32} />
            </div>
            <h3 className="text-2xl font-serif mb-4">The Challenge: Standardized Fashion</h3>
            <p className="text-brand-muted leading-relaxed">
              The market was saturated with generic, one-size-fits-all options. Clothéeo needed to break away from the conventional e-commerce model and solve the pain point of poor fit.
            </p>
          </motion.div>

          <motion.div 
            whileHover={{ y: -5 }}
            className="bg-white p-10 rounded-3xl border border-brand-gold/10 shadow-sm text-center"
          >
            <div className="w-16 h-16 bg-brand-gold/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
              <Ruler className="text-brand-gold" size={32} />
            </div>
            <h3 className="text-2xl font-serif mb-4">The Solution: True Customization</h3>
            <p className="text-brand-muted leading-relaxed">
              We designed a platform centered on individualization. By integrating a precise measurement engine and real-time visualization, we empowered users to create garments uniquely their own.
            </p>
          </motion.div>
        </div>
      </div>
    </section>
  );
};

const Features = () => {
  const features = [
    {
      title: "Custom Measurement Engine",
      description: "Users can input precise measurements for a guaranteed perfect fit, powered by an intelligent algorithm.",
      icon: Ruler
    },
    {
      title: "Real-time Fabric Preview",
      description: "A dynamic tool allows users to see their selected fabric and pattern choices instantly on the product model.",
      icon: Palette
    },
    {
      title: "Direct Tailor Connection",
      description: "A built-in messaging system facilitates direct communication with expert tailors for special requests.",
      icon: Scissors
    }
  ];

  return (
    <section className="py-24 bg-white">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 className="text-4xl font-serif text-center mb-16">Feature Highlights</h2>
        <div className="grid md:grid-cols-3 gap-8">
          {features.map((feature, i) => (
            <motion.div 
              key={i}
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              transition={{ delay: i * 0.1 }}
              viewport={{ once: true }}
              className="text-center p-6"
            >
              <div className="w-16 h-16 bg-brand-cream rounded-full flex items-center justify-center mx-auto mb-6 border border-brand-gold/20">
                <feature.icon className="text-brand-gold" size={28} />
              </div>
              <h3 className="text-xl font-serif mb-4">{feature.title}</h3>
              <p className="text-brand-muted text-sm leading-relaxed">
                {feature.description}
              </p>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
};

const Gallery = () => {
  const mockups = [
    {
      type: "Desktop",
      icon: Monitor,
      img: "https://images.unsplash.com/photo-1490481651871-ab68de25d43d?auto=format&fit=crop&q=80&w=2070",
      span: "col-span-1 md:col-span-2"
    },
    {
      type: "Mobile",
      icon: Smartphone,
      img: "https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?auto=format&fit=crop&q=80&w=2070",
      span: "col-span-1"
    },
    {
      type: "Tablet",
      icon: Tablet,
      img: "https://images.unsplash.com/photo-1558769132-cb1aea458c5e?auto=format&fit=crop&q=80&w=2070",
      span: "col-span-1"
    },
    {
      type: "Mobile",
      icon: Smartphone,
      img: "https://images.unsplash.com/photo-1445205170230-053b830c6050?auto=format&fit=crop&q=80&w=2071",
      span: "col-span-1"
    },
    {
      type: "Desktop",
      icon: Monitor,
      img: "https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&q=80&w=2070",
      span: "col-span-1 md:col-span-2"
    },
    {
      type: "Tablet",
      icon: Tablet,
      img: "https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&q=80&w=2070",
      span: "col-span-1"
    }
  ];

  return (
    <section className="py-24">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 className="text-4xl font-serif text-center mb-16">UI Gallery</h2>
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
          {mockups.map((mockup, i) => (
            <motion.div 
              key={i}
              whileHover={{ scale: 1.02 }}
              className={`${mockup.span} group relative aspect-video md:aspect-auto rounded-3xl overflow-hidden border border-brand-gold/10 shadow-lg bg-white`}
            >
              <img 
                src={mockup.img} 
                alt={`${mockup.type} Mockup`} 
                className="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                referrerPolicy="no-referrer"
              />
              <div className="absolute inset-0 bg-brand-dark/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                <div className="bg-white/90 backdrop-blur px-4 py-2 rounded-full flex items-center space-x-2">
                  <mockup.icon size={16} className="text-brand-gold" />
                  <span className="text-xs font-semibold uppercase tracking-wider">{mockup.type}</span>
                </div>
              </div>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default function App() {
  return (
    <div className="min-h-screen">
      <main>
        <Hero />
        <Story />
        <ProblemSolution />
        <Features />
        <Gallery />
      </main>
    </div>
  );
}
