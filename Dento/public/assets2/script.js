const hamburger=document.getElementById("hamburger"),menu=document.getElementById("menu"),close=document.getElementById("close");document.addEventListener("DOMContentLoaded",()=>{let e=document.querySelectorAll(".animated-number");e.forEach(e=>{let t=parseInt(e.getAttribute("data-target")),l=0,r=Math.ceil(t/90),s=()=>{l<t&&((l+=r)>t&&(l=t),e.textContent=l,requestAnimationFrame(s))};s()});let t=document.getElementById("scrollableDiv"),l=document.querySelectorAll(".testimonal-inside .card"),r=!1,s;function n(){s=setInterval(()=>{let e=t.scrollLeft,r=t.clientWidth+100;l[0].clientWidth;let s=e+r,n=t.scrollWidth-r;s>=n?i(t,"scrollLeft",0,1500):i(t,"scrollLeft",s,1500)},3e3)}function i(e,t,l,r){let s=e[t],n=l-s,i=0;!function l(){i+=20;let o=a(i,s,n,r);e[t]=o,i<r&&requestAnimationFrame(l)}()}function a(e,t,l,r){return(e/=r/2)<1?l/2*e*e+t:-l/2*(--e*(e-2)-1)+t}t.addEventListener("mousedown",()=>{r=!0,clearInterval(s)}),t.addEventListener("mouseup",()=>{if(r){r=!1;let e=t.scrollLeft,s=t.clientWidth,n=l[0].clientWidth,a=Math.round(e/n),o=a*n+(s-n)/2;i(t,"scrollLeft",o,600)}}),n()}),window.addEventListener("load",()=>{document.getElementById("preloader").style.display="none",document.getElementById("content").style.display="block"}),hamburger&&hamburger.addEventListener("click",()=>{let e=document.querySelectorAll(".hamburger-lines");e.forEach(e=>e.classList.toggle("hamburger-active")),menu.classList.toggle("menu-active")}),close&&close.addEventListener("click",()=>{let e=document.querySelectorAll(".hamburger-lines");e.forEach(e=>e.classList.toggle("hamburger-active")),menu.classList.toggle("menu-active")});const scrollableDiv=document.getElementById("scrollableDiv");let isDragging=!1,startX,scrollLeft;scrollableDiv.addEventListener("mousedown",e=>{isDragging=!0,startX=e.pageX-scrollableDiv.offsetLeft,scrollLeft=scrollableDiv.scrollLeft}),scrollableDiv.addEventListener("mouseleave",()=>{isDragging=!1}),scrollableDiv.addEventListener("mouseup",()=>{isDragging=!1}),scrollableDiv.addEventListener("mousemove",e=>{if(!isDragging)return;e.preventDefault();let t=e.pageX-scrollableDiv.offsetLeft,l=(t-startX)*2;scrollableDiv.scrollLeft=scrollLeft-l});