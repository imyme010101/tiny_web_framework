document.addEventListener("DOMContentLoaded", function(){
// 텝
const tabs = document.querySelectorAll('.tabs input[type="radio"]');
if(tabs){
  const tabContents = document.querySelectorAll('.tabs .tab-content');

  tabs.forEach((tab, index) => {
    tab.addEventListener('change', () => {
      tabContents.forEach(content => {
        content.classList.remove('active');
      });
      tabContents[index].classList.add('active');
    });
  });
}

// 토너먼트 팝업
const ttsPopupBtn = document.querySelector('.tts-popup');
if(ttsPopupBtn){
  const ttsPopup = document.querySelector('.AllSchedule-popup');

ttsPopupBtn.addEventListener('click', function(){
  ttsPopup.classList.toggle('active');
})
}


// 회원가입 팝업
let ccClose = document.querySelectorAll('.mp-ced');
let ccArea = document.querySelectorAll('.mp-wr');
let ccMore = document.querySelectorAll('.mp-mr')

for(let i = 0; i < ccMore.length; i++){

  ccMore[i].addEventListener('click', function(e){
    e.target;
    ccArea[i].classList.toggle('active')
  })

  ccClose[i].addEventListener('click', function(e){
    e.target;
    ccArea[i].classList.remove('active')
  })
}


});





