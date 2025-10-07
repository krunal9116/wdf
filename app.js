document.addEventListener('DOMContentLoaded', ()=>{

  const promos = [
    {title:'20% off on Pizzas', subtitle:'Use code PIZZA20'},
    {title:'Free Delivery above ₹500', subtitle:'Today only'},
    {title:'Buy 1 Get 1 - Burgers', subtitle:'Limited period'}
  ];

  const promoEl = document.getElementById('promo-slider');
  if(promoEl){
    let html = '<div class="promo-grid">';
    promos.forEach(p=>{ html += `<div class="card"><h3>${p.title}</h3><p>${p.subtitle}</p></div>`});
    html += '</div>';
    promoEl.innerHTML = html;
  }

  
  document.querySelectorAll('.faq-toggle').forEach(btn=>{
    btn.addEventListener('click', ()=>{
      const panel = btn.nextElementSibling;
      panel.style.display = (panel.style.display==='block') ? 'none' : 'block';
    })
  });

 
});
