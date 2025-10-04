// Advanced Particle System with Canvas
class ParticleSystem {
    constructor() {
        this.canvas = document.createElement('canvas');
        this.ctx = this.canvas.getContext('2d');
        this.particles = [];
        this.maxParticles = 100;
        
        this.canvas.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        `;
        
        document.body.appendChild(this.canvas);
        this.resize();
        window.addEventListener('resize', () => this.resize());
        
        this.init();
        this.animate();
    }
    
    resize() {
        this.canvas.width = window.innerWidth;
        this.canvas.height = window.innerHeight;
    }
    
    init() {
        for (let i = 0; i < this.maxParticles; i++) {
            this.particles.push({
                x: Math.random() * this.canvas.width,
                y: Math.random() * this.canvas.height,
                vx: (Math.random() - 0.5) * 0.5,
                vy: (Math.random() - 0.5) * 0.5,
                size: Math.random() * 3 + 1,
                color: this.getRandomColor(),
                opacity: Math.random() * 0.5 + 0.2
            });
        }
    }
    
    getRandomColor() {
        const colors = [
            'rgba(255, 255, 255, ',   // ขาว
            'rgba(59, 130, 246, ',    // น้ำเงิน
            'rgba(147, 197, 253, ',   // น้ำเงินอ่อน
            'rgba(191, 219, 254, '    // น้ำเงินซีด
        ];
        return colors[Math.floor(Math.random() * colors.length)];
    }
    
    animate() {
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        
        // Update and draw particles
        this.particles.forEach((particle, i) => {
            particle.x += particle.vx;
            particle.y += particle.vy;
            
            // Wrap around screen
            if (particle.x < 0) particle.x = this.canvas.width;
            if (particle.x > this.canvas.width) particle.x = 0;
            if (particle.y < 0) particle.y = this.canvas.height;
            if (particle.y > this.canvas.height) particle.y = 0;
            
            // Draw particle
            this.ctx.beginPath();
            this.ctx.arc(particle.x, particle.y, particle.size, 0, Math.PI * 2);
            this.ctx.fillStyle = particle.color + particle.opacity + ')';
            this.ctx.fill();
            
            // Connect nearby particles
            for (let j = i + 1; j < this.particles.length; j++) {
                const dx = this.particles[j].x - particle.x;
                const dy = this.particles[j].y - particle.y;
                const distance = Math.sqrt(dx * dx + dy * dy);
                
                if (distance < 150) {
                    this.ctx.beginPath();
                    this.ctx.strokeStyle = particle.color + (0.2 * (1 - distance / 150)) + ')';
                    this.ctx.lineWidth = 0.5;
                    this.ctx.moveTo(particle.x, particle.y);
                    this.ctx.lineTo(this.particles[j].x, this.particles[j].y);
                    this.ctx.stroke();
                }
            }
        });
        
        requestAnimationFrame(() => this.animate());
    }
}

// Initialize particle system
if (window.innerWidth > 768) { // Only on desktop
    new ParticleSystem();
}

// Interactive Mouse Trail with Canvas
class MouseTrail {
    constructor() {
        this.canvas = document.createElement('canvas');
        this.ctx = this.canvas.getContext('2d');
        this.trail = [];
        this.maxTrail = 20;
        
        this.canvas.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 9998;
        `;
        
        document.body.appendChild(this.canvas);
        this.resize();
        window.addEventListener('resize', () => this.resize());
        
        document.addEventListener('mousemove', (e) => {
            this.trail.push({
                x: e.clientX,
                y: e.clientY,
                life: 1
            });
            
            if (this.trail.length > this.maxTrail) {
                this.trail.shift();
            }
        });
        
        this.animate();
    }
    
    resize() {
        this.canvas.width = window.innerWidth;
        this.canvas.height = window.innerHeight;
    }
    
    animate() {
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        
        // Update and draw trail
        for (let i = 0; i < this.trail.length; i++) {
            const point = this.trail[i];
            point.life -= 0.05;
            
            if (point.life <= 0) {
                this.trail.splice(i, 1);
                i--;
                continue;
            }
            
            const gradient = this.ctx.createRadialGradient(
                point.x, point.y, 0,
                point.x, point.y, 30 * point.life
            );
            gradient.addColorStop(0, `rgba(236, 72, 153, ${point.life * 0.5})`);
            gradient.addColorStop(0.5, `rgba(139, 92, 246, ${point.life * 0.3})`);
            gradient.addColorStop(1, 'transparent');
            
            this.ctx.beginPath();
            this.ctx.arc(point.x, point.y, 30 * point.life, 0, Math.PI * 2);
            this.ctx.fillStyle = gradient;
            this.ctx.fill();
        }
        
        requestAnimationFrame(() => this.animate());
    }
}

new MouseTrail();

// Glowing Orbs that follow mouse
class GlowingOrb {
    constructor() {
        this.orbs = [];
        this.mouseX = window.innerWidth / 2;
        this.mouseY = window.innerHeight / 2;
        
        document.addEventListener('mousemove', (e) => {
            this.mouseX = e.clientX;
            this.mouseY = e.clientY;
        });
        
        for (let i = 0; i < 5; i++) {
            this.createOrb(i);
        }
    }
    
    createOrb(index) {
        const orb = document.createElement('div');
        const size = 20 + index * 10;
        const delay = index * 0.05;
        
        orb.style.cssText = `
            position: fixed;
            width: ${size}px;
            height: ${size}px;
            border-radius: 50%;
            background: radial-gradient(circle, 
                rgba(236, 72, 153, 0.3), 
                rgba(139, 92, 246, 0.2), 
                transparent);
            pointer-events: none;
            z-index: 1;
            filter: blur(10px);
            mix-blend-mode: screen;
        `;
        
        document.body.appendChild(orb);
        
        let x = this.mouseX;
        let y = this.mouseY;
        
        const animate = () => {
            x += (this.mouseX - x) * (0.1 - delay);
            y += (this.mouseY - y) * (0.1 - delay);
            
            orb.style.left = (x - size / 2) + 'px';
            orb.style.top = (y - size / 2) + 'px';
            
            requestAnimationFrame(animate);
        };
        
        animate();
    }
}

new GlowingOrb();

// Animated gradient background that reacts to mouse
document.addEventListener('mousemove', (e) => {
    const x = (e.clientX / window.innerWidth) * 100;
    const y = (e.clientY / window.innerHeight) * 100;
    
    document.body.style.backgroundPosition = `${x}% ${y}%`;
});