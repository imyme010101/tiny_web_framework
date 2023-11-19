function getImageUrl(name) {
  return new URL(`/src/assets/svg/${name}.svg`, import.meta.url).href;
}

function createNaverMap(id, center) {
  return new window.naver.maps.Map(id, {
    center: new window.naver.maps.LatLng(center.lat, center.lng), // Seoul, South Korea
    zoom: 30
  });
}

function setMarkerPosition(map, position, size, src, iconSrc) {
  let iconContent = null;
  
  if(typeof src !== "undefined") {
    iconContent = {
      content: `
        <div class="marker-box" style="width: ${size.width}px; height: ${size.height}px;">
          <img src="${src}" alt="MarkerDefaultSvg" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 11" class="" />
          <img src="${getImageUrl(iconSrc)}" alt="MarkerDefaultSvg" style="position: absolute; top: 14%; left: 20%; width: 60%; height: 60%; z-index: 11" class="pulse-me" />
          <div class="pulse-css" style="width: ${size.width/3}px; height: ${size.height/5}px; bottom: -${(size.height/10)}px; left: calc(50% - ${(size.width/3)/2}px); z-index: 10"></div>
        </div>
      `,
      size: new window.naver.maps.Size(size.width, size.height),
      anchor: new window.naver.maps.Point(size.width / 2, size.height),
    };
  }
  
  return new window.naver.maps.Marker({
    position: new window.naver.maps.LatLng(position.lat, position.lng),
    map: map,
    icon: iconContent,
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