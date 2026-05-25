<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Portfolio Ferdian Abdilah">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Ferdian Abdilah - Portofolio</title>
<link rel="icon" type="image/png" href="/logo.png?v=9999">
        <link rel="shortcut icon" type="image/png" href="/logo.png?v=9999">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
:root{
  --bg:#080808;--bg2:#0f0f0f;--bg3:#151515;--bg4:#1a1a1a;
  --text:#ede9e0;--muted:#777;--muted2:#555;
  --accent:#c8b89a;--border:#1e1e1e;--border2:#2a2a2a;
}
html{scroll-behavior:smooth}
body{background:var(--bg);color:var(--text);font-family:'DM Sans',sans-serif;overflow-x:hidden;cursor:none}
a{color:inherit;text-decoration:none}
#cursor{width:10px;height:10px;background:var(--accent);border-radius:50%;position:fixed;top:0;left:0;pointer-events:none;z-index:9999;transform:translate(-50%,-50%);mix-blend-mode:difference;transition:width .25s,height .25s}
#cursor-ring{width:36px;height:36px;border:1px solid rgba(200,184,154,.4);border-radius:50%;position:fixed;top:0;left:0;pointer-events:none;z-index:9998;transform:translate(-50%,-50%);transition:all .18s ease-out}
.cursor-hover #cursor{width:20px;height:20px}
.cursor-hover #cursor-ring{width:60px;height:60px;opacity:.5}
body::before{content:'';position:fixed;inset:0;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.04'/%3E%3C/svg%3E");pointer-events:none;z-index:1000;opacity:.35}

nav{position:fixed;top:0;left:0;right:0;z-index:500;padding:1.4rem 3rem;display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid transparent;transition:all .4s}
nav.scrolled{border-bottom-color:var(--border);backdrop-filter:blur(16px);background:rgba(8,8,8,.88)}
.nav-logo{font-family:'Playfair Display',serif;font-size:1.15rem;letter-spacing:.04em}
.nav-links{display:flex;gap:2.5rem;font-size:.78rem;color:var(--muted);letter-spacing:.1em;text-transform:uppercase}
.nav-links a{transition:color .2s}.nav-links a:hover{color:var(--text)}
.nav-badge{font-size:.7rem;padding:.32rem .9rem;border:1px solid #2e2e1e;color:var(--accent);border-radius:20px;display:flex;align-items:center;gap:.4rem}
.nav-badge::before{content:'';width:6px;height:6px;border-radius:50%;background:#6dbe6d;animation:pulse 2s ease-in-out infinite}
@keyframes pulse{0%,100%{box-shadow:0 0 0 0 rgba(109,190,109,.4)}50%{box-shadow:0 0 0 5px rgba(109,190,109,0)}}

.hero{min-height:100vh;display:flex;flex-direction:column;justify-content:flex-end;padding:0 3rem 4.5rem;position:relative;overflow:hidden}
.hero-glow{position:absolute;width:800px;height:600px;border-radius:50%;background:radial-gradient(ellipse,rgba(200,184,154,.055) 0%,transparent 70%);top:5%;right:-10%;pointer-events:none;animation:glow 8s ease-in-out infinite alternate}
@keyframes glow{0%{transform:translate(0,0) scale(1)}100%{transform:translate(-40px,30px) scale(1.08)}}
.hero-lines{position:absolute;inset:0;background-image:linear-gradient(to right,rgba(255,255,255,.018) 1px,transparent 1px),linear-gradient(to bottom,rgba(255,255,255,.018) 1px,transparent 1px);background-size:80px 80px;pointer-events:none;mask-image:radial-gradient(ellipse 80% 80% at 50% 50%,black 20%,transparent 80%)}
.hero-available{font-size:.72rem;letter-spacing:.14em;text-transform:uppercase;color:var(--accent);margin-bottom:1.8rem;display:flex;align-items:center;gap:.5rem;opacity:0;transform:translateY(20px);animation:fadeUp .8s ease .2s forwards}
.hero-available::before{content:'✦';font-size:.55rem}
.hero-title{font-family:'Playfair Display',serif;font-size:clamp(4.5rem,13vw,10rem);line-height:.92;font-weight:700;letter-spacing:-.02em;margin-bottom:3rem}
.hero-title .line{display:block;overflow:hidden}
.hero-title .line-inner{display:block;opacity:0;transform:translateY(100%);animation:slideUp .9s cubic-bezier(.16,1,.3,1) forwards}
.hero-title .line:nth-child(1) .line-inner{animation-delay:.3s}
.hero-title .line:nth-child(2) .line-inner{animation-delay:.5s}
em{font-style:italic;color:var(--accent)}
.hero-bottom{display:flex;gap:3rem;align-items:flex-end;border-top:1px solid var(--border);padding-top:2.2rem;opacity:0;transform:translateY(20px);animation:fadeUp .8s ease .8s forwards}
.hero-desc{max-width:340px;font-size:.88rem;line-height:1.8;color:#888;flex:1}
.hero-right{display:flex;flex-direction:column;gap:1.2rem;align-items:flex-end;flex:1}
.hero-tags{display:flex;gap:.6rem;flex-wrap:wrap;justify-content:flex-end}
.tag{font-size:.72rem;padding:.3rem .85rem;border:1px solid var(--border2);border-radius:20px;color:var(--muted);letter-spacing:.05em;transition:all .2s}
.tag:hover{border-color:var(--accent);color:var(--accent)}
.hero-cta{display:flex;gap:.8rem;flex-wrap:wrap;justify-content:flex-end}
.btn{font-size:.8rem;padding:.65rem 1.4rem;border:1px solid var(--border2);color:var(--muted);cursor:pointer;background:transparent;letter-spacing:.07em;border-radius:4px;transition:all .25s;font-family:'DM Sans',sans-serif}
.btn:hover{border-color:var(--accent);color:var(--text)}
.btn-primary{background:var(--accent);color:#0a0a0a;border-color:var(--accent);font-weight:500}
.btn-primary:hover{background:transparent;color:var(--accent)}
.scroll-hint{position:absolute;right:3rem;bottom:4.5rem;writing-mode:vertical-rl;font-size:.65rem;letter-spacing:.18em;text-transform:uppercase;color:var(--muted2);display:flex;align-items:center;gap:.5rem;animation:fadeUp .8s ease 1.2s both}
.scroll-hint::after{content:'';display:block;width:1px;height:50px;background:linear-gradient(to bottom,var(--muted2),transparent);margin-top:.5rem}

.marquee-wrapper{overflow:hidden;border-top:1px solid var(--border);border-bottom:1px solid var(--border);padding:1.2rem 0}
.marquee-track{display:flex;gap:4rem;white-space:nowrap;animation:marquee 22s linear infinite;font-family:'Playfair Display',serif;font-size:1.1rem;font-style:italic;color:var(--muted2)}
.marquee-track .dot{color:var(--accent);font-style:normal;font-size:.8rem}
@keyframes marquee{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}

section{padding:7rem 3rem}
.section-eyebrow{font-size:.68rem;letter-spacing:.22em;text-transform:uppercase;color:var(--accent);margin-bottom:3.5rem;padding-bottom:1.2rem;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:.8rem}
.section-eyebrow::before{content:'✦';font-size:.5rem}
.section-title{font-family:'Playfair Display',serif;font-size:clamp(2rem,5vw,3.8rem);font-weight:700;line-height:1.05;margin-bottom:3rem}
.reveal{opacity:0;transform:translateY(40px);transition:opacity .8s ease,transform .8s cubic-bezier(.16,1,.3,1)}
.reveal.visible{opacity:1;transform:translateY(0)}
.reveal-delay-1{transition-delay:.1s}.reveal-delay-2{transition-delay:.2s}.reveal-delay-3{transition-delay:.3s}

.portfolio-tabs{display:flex;margin-bottom:3.5rem;border-bottom:1px solid var(--border)}
.ptab{padding:.9rem 1.6rem;font-size:.82rem;color:var(--muted);cursor:pointer;border-bottom:2px solid transparent;margin-bottom:-1px;transition:all .25s;letter-spacing:.07em}
.ptab:first-child{padding-left:0}
.ptab.active{color:var(--text);border-bottom-color:var(--accent)}
.ptab:hover:not(.active){color:#aaa}
.tab-content{display:none}
.tab-content.active{display:block;animation:tabIn .4s ease}
@keyframes tabIn{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:translateY(0)}}

.projects-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1.5rem}
.project-card{background:var(--bg2);border:1px solid var(--border);border-radius:10px;overflow:hidden;transition:border-color .3s,transform .3s;cursor:pointer}
.project-card:hover{border-color:var(--border2);transform:translateY(-4px)}
.project-thumb{width:100%;aspect-ratio:16/9;background:var(--bg3);position:relative;overflow:hidden;display:flex;align-items:center;justify-content:center}
.project-thumb img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
.project-card:hover .project-thumb img{transform:scale(1.05)}
.project-thumb-placeholder{font-family:'Playfair Display',serif;font-size:2.5rem;font-style:italic;color:rgba(200,184,154,.15)}
.project-live{position:absolute;top:.8rem;right:.8rem;z-index:3;font-size:.65rem;padding:.25rem .6rem;border:1px solid rgba(200,184,154,.3);border-radius:3px;color:var(--accent);background:rgba(0,0,0,.5);letter-spacing:.08em;text-transform:uppercase}
.project-info{padding:1.4rem 1.4rem 1.6rem}
.project-meta{display:flex;justify-content:space-between;align-items:center;margin-bottom:.6rem}
.project-name{font-size:.97rem;font-weight:500}
.project-year{font-size:.72rem;color:var(--muted2)}
.project-desc{font-size:.82rem;color:var(--muted);line-height:1.65;margin-bottom:1rem}
.project-tags{display:flex;gap:.4rem;flex-wrap:wrap}
.ptag{font-size:.67rem;padding:.22rem .55rem;background:var(--bg3);border:1px solid var(--border2);border-radius:3px;color:var(--muted2)}
.project-link{display:inline-flex;align-items:center;gap:.3rem;font-size:.75rem;color:var(--accent);margin-top:1rem;transition:gap .2s}
.project-link:hover{gap:.6rem}

.certs-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:1.2rem}
.cert-card{background:var(--bg2);border:1px solid var(--border);border-radius:8px;padding:1.6rem;transition:border-color .25s,transform .25s;position:relative;overflow:hidden}
.cert-card::after{content:'';position:absolute;bottom:0;left:0;right:0;height:2px;background:linear-gradient(90deg,transparent,var(--accent),transparent);transform:scaleX(0);transition:transform .3s}
.cert-card:hover{border-color:var(--border2);transform:translateY(-3px)}.cert-card:hover::after{transform:scaleX(1)}
.cert-badge {
    width: 100%;
    height: 160px;
    padding: 0;
    overflow: hidden;
    border-radius: 8px;
    margin-bottom: 1rem;
    background: var(--bg3);
    border: 1px solid var(--border2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
}
.cert-name{font-size:.9rem;font-weight:500;margin-bottom:.3rem;line-height:1.3}
.cert-issuer{font-size:.74rem;color:var(--muted);margin-bottom:.2rem}
.cert-year{font-size:.7rem;color:var(--muted2)}

.stack-categories {
  display: flex;
  flex-direction: column;
  gap: 4rem;
}
.stack-category-header {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 1.8rem;
}
.stack-category-title {
  font-size: .68rem;
  letter-spacing: .22em;
  text-transform: uppercase;
  color: var(--accent);
  position: relative;
}
.stack-item{
  background:var(--bg2);
  border:1px solid var(--border);
  border-radius:8px;
  padding:1.1rem;
  text-align:center;
  transition:border-color .25s,transform .25s;

  min-width:110px;
  flex:0 0 auto;
  scroll-snap-align:start;
}
.stack-category-line {
  flex: 1;
  height: 1px;
  background: linear-gradient(to right, var(--border2), transparent);
}
.stack-icon{font-size:1.6rem;margin-bottom:.5rem;display:block}
.stack-name{font-size:.7rem;color:var(--muted);letter-spacing:.05em}

#contact{background:var(--bg2);border-top:1px solid var(--border)}
.contact-wrapper{display:grid;grid-template-columns:1fr 1.2fr;gap:5rem}
.contact-title{font-family:'Playfair Display',serif;font-size:clamp(2rem,4vw,3rem);line-height:1.1;margin-bottom:1.2rem}
.contact-desc{font-size:.88rem;color:var(--muted);line-height:1.75;margin-bottom:2.5rem}
.social-item{display:flex;align-items:center;gap:1rem;padding:1rem 0;border-bottom:1px solid var(--border);font-size:.85rem;color:var(--muted);transition:color .2s}
.social-item:hover{color:var(--text)}.social-item:hover .social-arrow{transform:translate(4px,-4px)}
.social-platform{font-size:.68rem;letter-spacing:.1em;text-transform:uppercase;color:var(--muted2);min-width:90px}
.social-handle{flex:1}
.social-arrow{margin-left:auto;font-size:.75rem;transition:transform .2s;color:var(--muted2)}
.contact-form{display:flex;flex-direction:column;gap:1.4rem}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
.form-group{display:flex;flex-direction:column;gap:.5rem}
.form-label{font-size:.7rem;letter-spacing:.1em;text-transform:uppercase;color:var(--muted2)}
.form-input{background:var(--bg3);border:1px solid var(--border);color:var(--text);padding:.85rem 1rem;font-size:.87rem;border-radius:6px;outline:none;font-family:'DM Sans',sans-serif;transition:border-color .2s,background .2s}
.form-input:focus{border-color:var(--accent);background:var(--bg4)}
.form-input::placeholder{color:var(--muted2)}
textarea.form-input{resize:vertical;min-height:130px;line-height:1.6}
.form-submit{background:var(--accent);color:#0a0a0a;border:none;padding:1rem 2rem;font-size:.85rem;font-weight:500;cursor:pointer;border-radius:6px;letter-spacing:.07em;font-family:'DM Sans',sans-serif;transition:all .25s;align-self:flex-start;display:flex;align-items:center;gap:.5rem}
.form-submit:hover{background:transparent;color:var(--accent);border:1px solid var(--accent);padding:.94rem 1.94rem}
.form-error{color:#e24b4a;font-size:.75rem;margin-top:.2rem}
.alert-success{background:rgba(109,190,109,.1);border:1px solid rgba(109,190,109,.25);color:#6dbe6d;padding:1rem 1.2rem;border-radius:6px;font-size:.85rem;margin-bottom:1.5rem}

#comments-section{border-top:1px solid var(--border);padding:5rem 3rem}
.comments-list{display:flex;flex-direction:column;gap:1.2rem;margin-bottom:3rem}
.comment-card{background:var(--bg2);border:1px solid var(--border);border-radius:8px;padding:1.4rem}
.comment-header{display:flex;align-items:center;gap:.8rem;margin-bottom:.8rem}
.comment-avatar{width:36px;height:36px;border-radius:50%;background:var(--bg3);border:1px solid var(--border2);display:flex;align-items:center;justify-content:center;font-size:.85rem;font-weight:500;color:var(--accent)}
.comment-name{font-size:.88rem;font-weight:500}
.comment-date{font-size:.72rem;color:var(--muted2);margin-left:auto}
.comment-body{font-size:.85rem;color:var(--muted);line-height:1.7}
.comment-img{margin-top:.8rem;max-width:100%;border-radius:6px;max-height:200px;object-fit:cover}
.comment-form-title{font-family:'Playfair Display',serif;font-size:1.5rem;margin-bottom:1.5rem}
.comment-form{display:flex;flex-direction:column;gap:1rem;max-width:600px}

footer{border-top:1px solid var(--border);padding:2.5rem 3rem;display:flex;justify-content:space-between;align-items:center;font-size:.76rem;color:var(--muted2)}
.footer-links{display:flex;gap:2rem}
.footer-links a:hover{color:var(--muted)}
.footer-logo{font-family:'Playfair Display',serif;color:var(--muted);font-size:.9rem}

@keyframes fadeUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
@keyframes slideUp{from{opacity:0;transform:translateY(100%)}to{opacity:1;transform:translateY(0)}}

/* ABOUT */
#about{
  border-top:1px solid var(--border);
}

.about-wrapper{
  display:grid;
  grid-template-columns:1.2fr .8fr;
  gap:4rem;
  align-items:center;
}

.about-text{
  font-size:.95rem;
  line-height:1.9;
  color:var(--muted);
  margin-bottom:1.5rem;
  max-width:700px;
}

.about-stats{
  display:flex;
  gap:3rem;
  margin-top:2.5rem;
  flex-wrap:wrap;
}

.about-stat h3{
  font-family:'Playfair Display',serif;
  font-size:2.2rem;
  color:var(--accent);
  margin-bottom:.3rem;
}

.about-stat span{
  font-size:.8rem;
  color:var(--muted2);
  letter-spacing:.08em;
  text-transform:uppercase;
}

.about-card{
  background:var(--bg2);
  border:1px solid var(--border);
  border-radius:14px;
  overflow:hidden;
  position:relative;
}

.about-card-line{
  height:3px;
  background:linear-gradient(
    90deg,
    transparent,
    var(--accent),
    transparent
  );
}

.about-card-content{
  padding:2rem;
}

.about-label{
  font-size:.7rem;
  letter-spacing:.14em;
  text-transform:uppercase;
  color:var(--accent);
}

.about-card h3{
  font-size:1.4rem;
  margin:1rem 0;
  font-family:'Playfair Display',serif;
}

.about-card p{
  color:var(--muted);
  line-height:1.8;
  font-size:.9rem;
}

@media(max-width:900px){
  .about-wrapper{
    grid-template-columns:1fr;
  }

  .about-stats{
    gap:2rem;
  }
}

@media(max-width:900px){
  nav{padding:1.2rem 1.5rem}.nav-links{display:none}
  .hero{padding:0 1.5rem 3.5rem}.scroll-hint{display:none}
  .hero-bottom{flex-direction:column;gap:2rem}
  .hero-right{align-items:flex-start}
  .hero-tags,.hero-cta{justify-content:flex-start}
  section,#contact,#comments-section{padding:5rem 1.5rem}
  .contact-wrapper{grid-template-columns:1fr;gap:3rem}
  .form-row{grid-template-columns:1fr}
  footer{flex-direction:column;gap:1rem;text-align:center}.footer-links{justify-content:center}
}





/* item horizontal */
.stack-item{
  min-width:110px;
  flex:0 0 auto;
  scroll-snap-align:start;
}

/* scrollbar */
.stack-scroll::-webkit-scrollbar{
  height:6px;
}
.stack-scroll::-webkit-scrollbar-thumb{
  background:var(--border2);
  border-radius:10px;
}
.stack-scroll::-webkit-scrollbar-thumb:hover{
  background:var(--accent);
}

.marquee-stack-outer {
  overflow: hidden;
  mask-image: linear-gradient(to right, transparent, black 6%, black 94%, transparent);
  -webkit-mask-image: linear-gradient(to right, transparent, black 6%, black 94%, transparent);
}

.marquee-stack-track {
  display: flex;
  gap: 1.2rem;
  width: max-content;
  animation: stackMarquee 30s linear infinite;
}

.marquee-stack-track.reverse {
  animation: stackMarqueeReverse 30s linear infinite;
}

.marquee-stack-outer:hover .marquee-stack-track {
  animation-play-state: paused;
}

@keyframes stackMarquee {
  0%   { transform: translateX(0); }
  100% { transform: translateX(-50%); }
}

@keyframes stackMarqueeReverse {
  0%   { transform: translateX(-50%); }
  100% { transform: translateX(0); }
}

.stack-categories {
  display: flex;
  flex-direction: column;
  gap: 3.5rem;
}

.stack-category-title {
  font-size: .72rem;
  letter-spacing: .14em;
  text-transform: uppercase;
  color: var(--muted2);
  margin-bottom: 1.4rem;
}

.stack-btn:hover{
  border-color:var(--accent);
  color:var(--accent);
}

.stack-btn.left{left:-10px;}
.stack-btn.right{right:-10px;}

.stack-item-logo {
  flex: 0 0 auto;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: .8rem;
  cursor: default;
}

.stack-logo-wrap {
  width: 130px;
  height: 130px;
  background: linear-gradient(145deg, #1a1a1a, #111);
  border: 1px solid var(--border2);
  border-radius: 28px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: border-color .3s, transform .3s, box-shadow .3s;
  overflow: hidden;
  position: relative;
}

.stack-logo-wrap::before {
  content: '';
  position: absolute;
  inset: 0;
  border-radius: 28px;
  background: radial-gradient(circle at 50% 0%, rgba(200,184,154,.08), transparent 70%);
  opacity: 0;
  transition: opacity .3s;
}

.stack-logo-wrap img {
  width: 72px;
  height: 72px;
  object-fit: contain;
  position: relative;
  z-index: 1;
  transition: transform .3s;
}


.stack-item-logo {
  flex: 0 0 auto;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: .8rem;
  cursor: default;
}

.stack-item-logo:hover .stack-logo-wrap {
  border-color: rgba(200,184,154,.5);
  transform: translateY(-8px);
  box-shadow: 
    0 20px 40px rgba(0,0,0,.4),
    0 0 0 1px rgba(200,184,154,.2);
}
.stack-item-logo:hover .stack-logo-wrap::before {
  opacity: 1;
}

.stack-item-logo:hover .stack-logo-wrap img {
  transform: scale(1.1);
}

.stack-item-logo .stack-name {
  font-size: .75rem;
  color: var(--muted);
  letter-spacing: .06em;
  transition: color .3s;
}

.stack-item-logo:hover .stack-name {
  color: var(--accent);
}
</style>
</head>
<body>

<div id="cursor"></div>
<div id="cursor-ring"></div>

<nav id="navbar">
  <div class="nav-logo">Perdi</div>
  <div class="nav-links">
        <a href="#about">About</a>
    <a href="#portfolio">Portfolio</a>
    <a href="#contact">Contact</a>
  </div>

</nav>

<!-- HERO -->
<section class="hero" id="home">
  <div class="hero-glow"></div>
  <div class="hero-lines"></div>
  <h1 class="hero-title">
    <span class="line"><span class="line-inner">Web</span></span>
    <span class="line"><span class="line-inner"><em>Develover</em></span></span>
  </h1>
  <div class="hero-bottom">
    <p class="hero-desc">
      Menciptakan website modern dengan tampilan clean, responsif, dan elegan.
      Mengubah ide dan desain menjadi pengalaman digital yang menarik dan mudah digunakan.
    </p>
    <div class="hero-right">
      <div class="hero-tags">
        <span class="tag">TypeScript</span>
        <span class="tag">React.js</span>
        <span class="tag">Tailwind CSS</span>
        <span class="tag">Next.js</span>
      </div>
      <div class="hero-cta">
        <button class="btn" onclick="document.getElementById('portfolio').scrollIntoView({behavior:'smooth'})">↓ explore my work</button>
        <button class="btn btn-primary" onclick="document.getElementById('contact').scrollIntoView({behavior:'smooth'})">↗ Open to opportunities</button>
      </div>
    </div>
  </div>
  <!-- <div class="scroll-hint">Scroll</div> -->
</section>

<!-- MARQUEE -->
<div class="marquee-wrapper">
  <div class="marquee-track" aria-hidden="true">
    <span>
      Frontend Development <span class="dot">✦</span>
      UI/UX Design <span class="dot">✦</span>
      React.js <span class="dot">✦</span>
      TypeScript <span class="dot">✦</span>
      Tailwind CSS <span class="dot">✦</span>
      Next.js <span class="dot">✦</span>
      Clean Code <span class="dot">✦</span>
      Responsive Design <span class="dot">✦</span>
      Frontend Development <span class="dot">✦</span>
      UI/UX Design <span class="dot">✦</span>
      React.js <span class="dot">✦</span>
      TypeScript <span class="dot">✦</span>
      Tailwind CSS <span class="dot">✦</span>
      Next.js <span class="dot">✦</span>
      Clean Code <span class="dot">✦</span>
      Responsive Design <span class="dot">✦</span>
    </span>
  </div>
</div>

<!-- ABOUT -->
<section id="about">
  <div class="section-eyebrow reveal">About Me</div>

  <div class="about-wrapper">
    <div class="about-left reveal">
      <h1 class="section-title" style="margin-bottom:1.5rem">
        <em>Ferdian Abdilah</em>
      </h1>

      <p class="about-text">
        Halo, saya <strong>Ferdian Abdilah</strong> — seorang Web Developer
        yang fokus membangun website modern, cepat, responsif,
        dan memiliki pengalaman pengguna yang nyaman.
      </p>

      <p class="about-text">
        Saya suka menggabungkan desain minimalis dengan teknologi modern
        seperti React.js, Next.js, Laravel, dan Tailwind CSS untuk
        menciptakan produk digital yang elegan dan fungsional.
      </p>

      <div class="about-stats">
        <div class="about-stat">
          <h3>3+</h3>
          <span>Tahun Belajar</span>
        </div>

        <div class="about-stat">
          <h3>3+</h3>
          <span>Project Dibuat</span>
        </div>

        <div class="about-stat">
          <h3>5+</h3>
          <span>Teknologi Utama</span>
        </div>
      </div>
    </div>

    <div class="about-right reveal reveal-delay-2">
      <div class="about-card">
        <div class="about-card-line"></div>

        <div class="about-card-content">
          <span class="about-label">Current Focus</span>
          <h3>Web Developer</h3>

          <p>
            Fokus mengembangkan aplikasi web modern dengan
            performa tinggi, UI elegan, dan clean architecture.
          </p>

          <div class="hero-tags" style="justify-content:flex-start;margin-top:1.5rem">
            <span class="tag">Laravel</span>
            <span class="tag">React.js</span>
            <span class="tag">Next.js</span>
            <span class="tag">Tailwind</span>
            <span class="tag">MySQL</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PORTFOLIO -->
<section id="portfolio">
  <div class="section-eyebrow reveal">Portfolio Showcase</div>
  <h2 class="section-title reveal">Explore my journey through<br><em>projects, certifications,</em><br>and technical expertise.</h2>

  <div class="portfolio-tabs reveal reveal-delay-2">
    <div class="ptab active" onclick="switchTab('projects',this)">Projects</div>
    <div class="ptab" onclick="switchTab('certificates',this)">Certificates</div>
    <div class="ptab" onclick="switchTab('stack',this)">Tech Stack</div>
  </div>

  {{-- PROJECTS --}}
  <div id="tab-projects" class="tab-content active">
    @if($projects->isNotEmpty())
      <div class="projects-grid">
        @foreach($projects as $i => $project)
        <div class="project-card reveal {{ $i > 0 ? 'reveal-delay-' . min($i, 3) : '' }}">
          <div class="project-thumb">
            @if($project->thumbnail)
              <img src="{{ $project->thumbnail_url }}" alt="{{ $project->title }}">
            @else
              <div class="project-thumb-placeholder" style="background:linear-gradient(135deg,#1a1a2e,#0f3460);">
                {{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}
              </div>
            @endif
            @if($project->live_url)
              <span class="project-live">Live ↗</span>
            @endif
          </div>
          <div class="project-info">
            <div class="project-meta">
              <span class="project-name">{{ $project->title }}</span>
              <span class="project-year">{{ $project->year }}</span>
            </div>
            <p class="project-desc">{{ $project->description }}</p>
            @if($project->tech_stack)
            <div class="project-tags">
              @foreach($project->tech_stack as $tech)
                <span class="ptag">{{ $tech }}</span>
              @endforeach
            </div>
            @endif
            @if($project->live_url)
              <a href="{{ $project->live_url }}" target="_blank" class="project-link">View Project →</a>
            @endif
          </div>
        </div>
        @endforeach
      </div>
    @else
      <p style="color:var(--muted);font-size:.9rem">Belum ada project yang dipublikasikan.</p>
    @endif
  </div>

  {{-- CERTIFICATES --}}
  <div id="tab-certificates" class="tab-content">
    @if($certificates->isNotEmpty())
      <div class="certs-grid">
        @foreach($certificates as $i => $cert)
        <div class="cert-card reveal {{ $i > 0 ? 'reveal-delay-' . min($i, 3) : '' }}">
          @if($cert->image_url)
              <div class="cert-badge" style="width:100%;height:160px;">
                  <img src="{{ $cert->image_url }}" alt="{{ $cert->name }}"
                      style="width:100%;height:100%;object-fit:contain;padding:.8rem;background:var(--bg3);">
              </div>
          @else
              <div class="cert-badge">{{ $cert->emoji }}</div>
          @endif
          <div class="cert-name">{{ $cert->name }}</div>
          <div class="cert-issuer">{{ $cert->issuer }}</div>
          <div class="cert-year">{{ $cert->year }}</div>
          @if($cert->credential_url)
            <a href="{{ $cert->credential_url }}" target="_blank" class="project-link" style="margin-top:.8rem">Lihat Credential →</a>
          @endif
        </div>
        @endforeach
      </div>
    @else
      <p style="color:var(--muted);font-size:.9rem">Belum ada sertifikat yang ditambahkan.</p>
    @endif
  </div>

  {{-- TECH STACK (static) --}}
<div id="tab-stack" class="tab-content">
  <div class="stack-categories">

    <!-- ROW 1: Frontend -->
    <div class="reveal">
      <div class="stack-category-header">
        <span class="stack-category-title">Frontend</span>
      <div class="stack-category-line"></div>
    </div>
      <div class="marquee-stack-outer">
        <div class="marquee-stack-track">
          <!-- set 1 -->
          <div class="stack-item-logo">
            <div class="stack-logo-wrap"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg" alt="React"></div>
            <span class="stack-name">React.js</span>
          </div>
          <div class="stack-item-logo">
            <div class="stack-logo-wrap"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/typescript/typescript-original.svg" alt="TypeScript"></div>
            <span class="stack-name">TypeScript</span>
          </div>
          <div class="stack-item-logo">
            <div class="stack-logo-wrap"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" alt="JavaScript"></div>
            <span class="stack-name">JavaScript</span>
          </div>
          <div class="stack-item-logo">
            <div class="stack-logo-wrap" style="background:#0ea5e9;"><img src="https://upload.wikimedia.org/wikipedia/commons/d/d5/Tailwind_CSS_Logo.svg" alt="Tailwind"></div>
            <span class="stack-name">Tailwind</span>
          </div>
          <div class="stack-item-logo">
            <div class="stack-logo-wrap"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" alt="HTML"></div>
            <span class="stack-name">HTML</span>
          </div>
          <div class="stack-item-logo">
            <div class="stack-logo-wrap"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" alt="CSS"></div>
            <span class="stack-name">CSS</span>
          </div>
          <div class="stack-item-logo">
            <div class="stack-logo-wrap" style="background:#000;"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nextjs/nextjs-original.svg" alt="Next.js"></div>
            <span class="stack-name">Next.js</span>
          </div>
          <!-- set 2 (duplikat untuk loop seamless) -->
          <div class="stack-item-logo">
            <div class="stack-logo-wrap"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg" alt="React"></div>
            <span class="stack-name">React.js</span>
          </div>
          <div class="stack-item-logo">
            <div class="stack-logo-wrap"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/typescript/typescript-original.svg" alt="TypeScript"></div>
            <span class="stack-name">TypeScript</span>
          </div>
          <div class="stack-item-logo">
            <div class="stack-logo-wrap"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" alt="JavaScript"></div>
            <span class="stack-name">JavaScript</span>
          </div>
          <div class="stack-item-logo">
            <div class="stack-logo-wrap" style="background:#0ea5e9;"><img src="https://upload.wikimedia.org/wikipedia/commons/d/d5/Tailwind_CSS_Logo.svg" alt="Tailwind"></div>
            <span class="stack-name">Tailwind</span>
          </div>
          <div class="stack-item-logo">
            <div class="stack-logo-wrap"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" alt="HTML"></div>
            <span class="stack-name">HTML</span>
          </div>
          <div class="stack-item-logo">
            <div class="stack-logo-wrap"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" alt="CSS"></div>
            <span class="stack-name">CSS</span>
          </div>
          <div class="stack-item-logo">
            <div class="stack-logo-wrap" style="background:#000;"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nextjs/nextjs-original.svg" alt="Next.js"></div>
            <span class="stack-name">Next.js</span>
          </div>
        </div>
      </div>
    </div>

    <!-- ROW 2: Backend (arah terbalik) -->
    <div class="reveal reveal-delay-1">
      <div class="stack-category-header">
        <span class="stack-category-title">Backend</span>
      <div class="stack-category-line"></div>
    </div>
      <div class="marquee-stack-outer">
        <div class="marquee-stack-track reverse">
          <!-- set 1 -->
          <div class="stack-item-logo">
            <div class="stack-logo-wrap"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" alt="PHP"></div>
            <span class="stack-name">PHP</span>
          </div>
          <div class="stack-item-logo">
            <div class="stack-logo-wrap" style="background:#f9322c;"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg" alt="Laravel"></div>
            <span class="stack-name">Laravel</span>
          </div>
          <div class="stack-item-logo">
            <div class="stack-logo-wrap"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" alt="MySQL"></div>
            <span class="stack-name">MySQL</span>
          </div>
          <div class="stack-item-logo">
            <div class="stack-logo-wrap"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg" alt="Node.js"></div>
            <span class="stack-name">Node.js</span>
          </div>
          <div class="stack-item-logo">
            <div class="stack-logo-wrap"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/git/git-original.svg" alt="Git"></div>
            <span class="stack-name">Git</span>
          </div>
          <div class="stack-item-logo">
            <div class="stack-logo-wrap" style="background:#fff;"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg" alt="GitHub"></div>
            <span class="stack-name">GitHub</span>
          </div>
          <div class="stack-item-logo">
            <div class="stack-logo-wrap"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/linux/linux-original.svg" alt="Linux"></div>
            <span class="stack-name">Linux</span>
          </div>
          <!-- set 2 (duplikat) -->
          <div class="stack-item-logo">
            <div class="stack-logo-wrap"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" alt="PHP"></div>
            <span class="stack-name">PHP</span>
          </div>
          <div class="stack-item-logo">
            <div class="stack-logo-wrap" style="background:#f9322c;"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg" alt="Laravel"></div>
            <span class="stack-name">Laravel</span>
          </div>
          <div class="stack-item-logo">
            <div class="stack-logo-wrap"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" alt="MySQL"></div>
            <span class="stack-name">MySQL</span>
          </div>
          <div class="stack-item-logo">
            <div class="stack-logo-wrap"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg" alt="Node.js"></div>
            <span class="stack-name">Node.js</span>
          </div>
          <div class="stack-item-logo">
            <div class="stack-logo-wrap"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/git/git-original.svg" alt="Git"></div>
            <span class="stack-name">Git</span>
          </div>
          <div class="stack-item-logo">
            <div class="stack-logo-wrap" style="background:#fff;"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg" alt="GitHub"></div>
            <span class="stack-name">GitHub</span>
          </div>
          <div class="stack-item-logo">
            <div class="stack-logo-wrap"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/linux/linux-original.svg" alt="Linux"></div>
            <span class="stack-name">Linux</span>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</section>

<!-- CONTACT -->
<section id="contact">
  <div class="section-eyebrow reveal">Contact Me</div>
  <div class="contact-wrapper">
    <div class="reveal">
      <h2 class="contact-title">Have something<br><em>in mind?</em><br>Let's connect.</h2>
      <p class="contact-desc">Feel free to reach out jika ingin kolaborasi, diskusi ide, atau sekadar say hello.</p>
      <div>
        <a href="https://github.com/frdianabdlh1" class="social-item" target="_blank">
          <span class="social-platform">GitHub</span>
          <span class="social-handle">@frdianabdlh1</span>
          <span class="social-arrow">↗</span>
        </a>
        <a href="https://www.instagram.com/frdianabdlh1" class="social-item" target="_blank">
          <span class="social-platform">Instagram</span>
          <span class="social-handle">@frdianabdlh1</span>
          <span class="social-arrow">↗</span>
        </a>
        </a>
        <a href="https://www.tiktok.com/@capcinrasaduren_" class="social-item" target="_blank">
          <span class="social-platform">TikTok</span>
          <span class="social-handle">@capcinrasaduren</span>
          <span class="social-arrow">↗</span>
        </a>
      </div>
    </div>

    <div class="reveal reveal-delay-2">
      @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
      @endif
      <form action="{{ route('messages.store') }}" method="POST" class="contact-form">
        @csrf
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-input" placeholder="Nama kamu" value="{{ old('name') }}" required>
            @error('name')<span class="form-error">{{ $message }}</span>@enderror
          </div>
          <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-input" placeholder="email@example.com" value="{{ old('email') }}" required>
            @error('email')<span class="form-error">{{ $message }}</span>@enderror
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Subjek</label>
          <input type="text" name="subject" class="form-input" placeholder="Tentang apa?" value="{{ old('subject') }}">
        </div>
        <div class="form-group">
          <label class="form-label">Pesan</label>
          <textarea name="body" class="form-input" placeholder="Ceritakan ideamu...">{{ old('body') }}</textarea>
          @error('body')<span class="form-error">{{ $message }}</span>@enderror
        </div>
        <button type="submit" class="form-submit">Send Message <span>→</span></button>
      </form>
    </div>
  </div>
</section>

<!-- COMMENTS -->
<!-- <section id="comments-section">
  <div class="section-eyebrow reveal">Comments</div>
  <h2 class="section-title reveal" style="font-size:2rem;margin-bottom:2rem">Leave your thoughts here</h2>

  {{-- Approved comments --}}
  @if($comments->isNotEmpty())
  <div class="comments-list reveal">
    @foreach($comments as $comment)
    <div class="comment-card">
      <div class="comment-header">
        <div class="comment-avatar">{{ strtoupper(substr($comment->name, 0, 1)) }}</div>
        <span class="comment-name">{{ $comment->name }}</span>
        <span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
      </div>
      <p class="comment-body">{{ $comment->body }}</p>
      @if($comment->image)
        <img src="{{ $comment->image_url }}" alt="Comment image" class="comment-img">
      @endif
    </div>
    @endforeach
  </div>
  @endif

  {{-- Comment form --}}
  @if(session('comment_success'))
    <div class="alert-success reveal">{{ session('comment_success') }}</div>
  @endif
  <div class="reveal">
    <h3 class="comment-form-title">Tinggalkan komentar</h3>
    <form action="{{ route('comments.store') }}" method="POST" enctype="multipart/form-data" class="comment-form">
      @csrf
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Nama *</label>
          <input type="text" name="name" class="form-input" placeholder="Nama kamu" value="{{ old('name') }}" required>
          @error('name')<span class="form-error">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
          <label class="form-label">Email (opsional)</label>
          <input type="email" name="email" class="form-input" placeholder="email@example.com" value="{{ old('email') }}">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Komentar *</label>
        <textarea name="body" class="form-input" placeholder="Tulis komentarmu...">{{ old('body') }}</textarea>
        @error('body')<span class="form-error">{{ $message }}</span>@enderror
      </div>
      <div class="form-group">
        <label class="form-label">Upload Gambar (opsional)</label>
        <input type="file" name="image" class="form-input" accept="image/*" style="padding:.6rem 1rem">
        @error('image')<span class="form-error">{{ $message }}</span>@enderror
      </div>
      <button type="submit" class="form-submit">Post Comment <span>→</span></button>
    </form>
  </div>
</section> -->

<footer>
  <span class="footer-logo">Perdi </span>
  <span>© {{ date('Y') }} Ferdian Abdilah — All rights reserved.</span>
  <div class="footer-links">
    <a href="https://github.com/frdianablh1" target="_blank">GitHub</a>
    <a href="https://www.instagram.com/frdianabdlh1/" target="_blank">Instagram</a>
  </div>
</footer>

<script>
const cursor = document.getElementById('cursor');
const ring = document.getElementById('cursor-ring');
let mx=0,my=0,rx=0,ry=0;
document.addEventListener('mousemove',e=>{mx=e.clientX;my=e.clientY});
(function animate(){
  cursor.style.left=mx+'px';cursor.style.top=my+'px';
  rx+=(mx-rx)*.12;ry+=(my-ry)*.12;
  ring.style.left=rx+'px';ring.style.top=ry+'px';
  requestAnimationFrame(animate);
})();
document.querySelectorAll('a,button,.project-card,.cert-card,.stack-item,.ptab').forEach(el=>{
  el.addEventListener('mouseenter',()=>document.body.classList.add('cursor-hover'));
  el.addEventListener('mouseleave',()=>document.body.classList.remove('cursor-hover'));
});

window.addEventListener('scroll',()=>document.getElementById('navbar').classList.toggle('scrolled',scrollY>60));

const obs=new IntersectionObserver(entries=>entries.forEach(e=>{if(e.isIntersecting)e.target.classList.add('visible')}),{threshold:.12});
document.querySelectorAll('.reveal').forEach(el=>obs.observe(el));

function switchTab(id,el){
  document.querySelectorAll('.tab-content').forEach(t=>t.classList.remove('active'));
  document.querySelectorAll('.ptab').forEach(t=>t.classList.remove('active'));
  document.getElementById('tab-'+id).classList.add('active');
  el.classList.add('active');
}

// tombol manual (punya kamu)
// function scrollStack(btn, amount){
//   const container = btn.parentElement.querySelector('.stack-scroll');
//   container.scrollBy({
//     left: amount,
//     behavior: 'smooth'
//   });
// }

// AUTO SLIDE
// document.querySelectorAll('.stack-scroll').forEach(container => {

//   let autoSlide = setInterval(() => {
//     container.scrollBy({
//       left: 220,
//       behavior: 'smooth'
//     });

//     // kalau sudah mentok kanan → balik ke kiri
//     if (container.scrollLeft + container.clientWidth >= container.scrollWidth - 5) {
//       setTimeout(() => {
//         container.scrollTo({
//           left: 0,
//           behavior: 'smooth'
//         });
//       }, 800);
//     }

//   }, 2500); // kecepatan (ms)

//   // PAUSE kalau di hover
//   container.addEventListener('mouseenter', () => {
//     clearInterval(autoSlide);
//   });

//   // LANJUT lagi kalau mouse keluar
//   container.addEventListener('mouseleave', () => {
//     autoSlide = setInterval(() => {
//       container.scrollBy({
//         left: 220,
//         behavior: 'smooth'
//       });

//       if (container.scrollLeft + container.clientWidth >= container.scrollWidth - 5) {
//         setTimeout(() => {
//           container.scrollTo({
//             left: 0,
//             behavior: 'smooth'
//           });
//         }, 800);
//       }

//     }, 2500);
//   });

// });
</script>
</body>
</html>
