function getImageUrl(name) {
  return new URL(`/src/assets/svg/${name}.svg`, import.meta.url).href;
}

function createNaverMap(id, center) {
  return new window.naver.maps.Map(id, {
    center: new window.naver.maps.LatLng(center.lat, center.lng), // Seoul, South Korea
    zoom: 30
  });
}

function setMarkerPosition(map, index, position, size, bg, iconSrc, text) {
  let iconContent = null;

  let cHtml = `
    <div class="marker-box" style="position: relative; width: ${size.width}px; height: ${size.height}px;};" id="marker-box-${index}" data-index="${index}">
        <div style="position:absolute; left: 50%; transform: translateX(-50%); width: ${size.width-10}px; height: ${size.height-10}px; background: ${bg}; margin: 0 auto; border-radius: 100%; padding: 3px;">
            <div style="width: ${size.width-16}px; height: ${size.height-16}px; background: #ffffff; margin: 0 auto; border-radius: 100%; padding: 2px;">
                <div style="position:relative; width: ${size.width-16-4}px; height: ${size.height-16-4}px; background: #6b7280; margin: 0 auto; border-radius: 100%;display: flex;align-items: center;justify-content: center;"> 
                  <svg width="28" height="34" viewBox="0 0 28 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M23.6901 23.4853C21.5057 23.1223 18.5237 21.1171 18.5287 20.2544L18.5414 18.0745C18.5462 17.2617 19.7294 15.7473 20.2372 14.349C20.285 14.2172 20.5852 14.3711 20.8797 14.0385C21.4342 13.4052 21.5211 12.4388 21.6496 11.9992C21.8544 11.3078 20.9577 11.2745 20.9577 11.2745C20.9577 11.2745 21.6473 7.64332 21.067 5.34388C20.2824 2.21255 15.9699 0.611996 14.2788 0.602139C12.5855 0.592269 8.26108 2.14248 7.43578 5.26442C6.82877 7.55694 7.49085 11.196 7.49085 11.196C7.49085 11.196 6.62594 11.2191 6.82046 11.9128C6.94607 12.354 7.08133 13.3215 7.63271 13.9613C7.92115 14.2972 8.09709 14.1462 8.14333 14.2786C8.63477 15.6827 9.80031 17.2107 9.79557 18.0235L9.78287 20.2034C9.77784 21.0661 6.77052 23.0364 4.58201 23.3739C1.77157 23.8059 0.373099 25.6173 1.00423 30.1591C1.31981 32.427 7.69424 33.439 14.015 33.3918C20.3347 33.5127 26.8166 32.5756 27.1586 30.3115C27.8448 25.7775 26.4975 23.95 23.6901 23.4853Z" fill="#9ca3af"/>
                  </svg>
                  <span style="position:absolute; top:50%; transform: translateY(-50%); margin: 0 auto; font-size: 12px; color: #fff;">${text.name}</span>
                </div>
            </div>
        </div>
        
        <div style="position:absolute; bottom: 1px; left: 50%; transform: translateX(-50%); width: 0; height: 0; border-left: 4px solid transparent; border-right: 4px solid transparent; border-top: 12px solid ${bg};"></div>
    </div>
  `;

  // cHtml += iconSrc != null ? `<img src="${getImageUrl(iconSrc)}" style="position: absolute; top: 14%; left: 20%; width: 60%; height: 60%; z-index: 11" class="pulse-me" />` : `<span class="flex items-center justify-center text-xs font-medium" style="position: absolute; top: 0%; left: 0%; width: 100%; height: 100%; padding-bottom: 12%; z-index: 11; color: ${text.color};">${text.name}</span>`;

  cHtml += `
  `;

  iconContent = {
    content: cHtml,
    size: new window.naver.maps.Size(size.width, size.height),
    anchor: new window.naver.maps.Point(size.width / 2, size.height),
  };
  
  return new window.naver.maps.Marker({
    position: new window.naver.maps.LatLng(position.lat, position.lng),
    map: map,
    icon: iconContent,
    id: 'marker-test',
    zIndex: 10
  });
}

function updateMarker(marker, size, classs, src) {
  marker.setIcon({
    icon: {
      content: `<img src="${src}" alt="MarkerDefaultSvg" style="width: ${size.width}px; height: ${size.height}px;" class="${classs}" />`,
      size: new window.naver.maps.Size(size.width, size.height),
      anchor: new window.naver.maps.Point(size.width / 2, size.height),
    }
  });
}

export default {
  createNaverMap,
  setMarkerPosition,
  updateMarker
};