/* チャットページに移動した際、ページ下部を表示する */
window.addEventListener('DOMContentLoaded', ()=>{
  let target = document.querySelector('#scroll-inner');
  target.scrollIntoView(false);
});
