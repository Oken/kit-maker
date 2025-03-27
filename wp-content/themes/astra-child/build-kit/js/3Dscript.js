const LOADER = document.getElementById('js-loader');

const TEXTURE_TRAY = document.getElementById('texture');
const COLOR_TRAYS = document.getElementsByClassName('js-tray-slide');
const DRAG_NOTICE = document.getElementById('js-drag-notice');

var theModel;

const MODEL_PATH = ABSURL + "/build-kit/models/full-kit.glb";

var shirt = ['shirt-primary', 'shirt-secondary', 'shirt-accent1', 'shirt-accent2'];

var short = ['short-primary', 'short-secondary', 'short-accent1', 'short-accent2'];

var socks = ['socks-primary', 'socks-secondary', 'socks-accent1', 'socks-accent2'];

var activeOption = 'shirt';
var loaded = false;


const colors = [
{
  color: '131417' },

{
  color: '374047' },

{
  color: '5f6e78' },

{
  color: '7f8a93' },

{
  color: '97a1a7' },

{
  color: 'acb4b9' },

{
  color: 'DF9998' },

{
  color: '7C6862' },

{
  color: 'A3AB84' },

{
  color: 'D6CCB1' },

{
  color: 'F8D5C4' },

{
  color: 'A3AE99' },

{
  color: 'EFF2F2' },

{
  color: 'B0C5C1' },

{
  color: '8B8C8C' },

{
  color: '565F59' },

{
  color: 'CB304A' },

{
  color: 'FED7C8' },

{
  color: 'C7BDBD' },

{
  color: '3DCBBE' },

{
  color: '264B4F' },

{
  color: '389389' },

{
  color: '85BEAE' },

{
  color: 'F2DABA' },

{
  color: 'F2A97F' },

{
  color: 'D85F52' },

{
  color: 'D92E37' },

{
  color: 'FC9736' },

{
  color: 'F7BD69' },

{
  color: 'A4D09C' },

{
  color: '4C8A67' },

{
  color: '25608A' },

{
  color: '75C8C6' },

{
  color: 'F5E4B7' },

{
  color: 'E69041' },

{
  color: 'E56013' },

{
  color: '11101D' },

{
  color: '630609' },

{
  color: 'C9240E' },

{
  color: 'EC4B17' },

{
  color: '281A1C' },

{
  color: '4F556F' },

{
  color: '64739B' },

{
  color: 'CDBAC7' },

{
  color: '946F43' },

{
  color: '66533C' },

{
  color: '173A2F' },

{
  color: '153944' },

{
  color: '27548D' },

{
  color: '438AAC' }];




const BACKGROUND_COLOR = 0xf1f1f1;
// Init the scene
const scene = new THREE.Scene();
// Set background
scene.background = new THREE.Color(BACKGROUND_COLOR);
scene.fog = new THREE.Fog(BACKGROUND_COLOR, 20, 100);

const canvas = document.querySelector('#c');

// Init the renderer
const renderer = new THREE.WebGLRenderer({ canvas, antialias: true, preserveDrawingBuffer: true });

renderer.shadowMap.enabled = true;
renderer.setPixelRatio(window.devicePixelRatio);

var cameraFar = 5;

document.getElementById('canvas-wrapper').appendChild(renderer.domElement);

// Add a camerra
var camera = new THREE.PerspectiveCamera(50, window.innerWidth / window.innerHeight, 0.1, 1000);
camera.position.z = cameraFar;
camera.position.x = 0;

// Initial material
const INITIAL_MTL = new THREE.MeshPhongMaterial({ color: 0xf1f1f1, shininess: 10 });

const INITIAL_MAP = [
{ childID: "shirt-primary", mtl: INITIAL_MTL },
{ childID: "shirt-secondary", mtl: INITIAL_MTL },
{ childID: "shirt-accent1", mtl: INITIAL_MTL },
{ childID: "shirt-accent2", mtl: INITIAL_MTL },
{ childID: "short-primary", mtl: INITIAL_MTL },
{ childID: "short-secondary", mtl: INITIAL_MTL },
{ childID: "short-accent1", mtl: INITIAL_MTL },
{ childID: "short-accent2", mtl: INITIAL_MTL },
{ childID: "socks-primary", mtl: INITIAL_MTL },
{ childID: "socks-secondary", mtl: INITIAL_MTL },
{ childID: "socks-accent1", mtl: INITIAL_MTL },
{ childID: "socks-accent2", mtl: INITIAL_MTL }
];


// Init the object loader
var loader = new THREE.GLTFLoader();

loader.load(MODEL_PATH, function (gltf) {
  theModel = gltf.scene;

  theModel.traverse(o => {
    if (o.isMesh) {
      o.castShadow = true;
      o.receiveShadow = true;
    }
  });

  // Set the models initial scale
  theModel.scale.set(1, 1, 1);
  theModel.rotation.y = Math.PI;

  // Offset the y position a bit
  theModel.position.y = -3;

  // Set initial textures
  for (let object of INITIAL_MAP) {
    initColor(theModel, object.childID, object.mtl);
  }

  // Add the model to the scene
  scene.add(theModel);

  // Remove the loader
  LOADER.remove();

}, undefined, function (error) {
  console.error(error);
});

// Function - Add the textures to the models
function initColor(parent, type, mtl) {
  parent.traverse(o => {
    if (o.isMesh) {
      if (o.name.includes(type)) {
        o.material = mtl;
        o.nameID = type; // Set a new property to identify this object
      }
    }
  });
}

// Add lights
var hemiLight = new THREE.HemisphereLight(0xffffff, 0xffffff, 0.61);
hemiLight.position.set(0, 50, 0);
// Add hemisphere light to scene
scene.add(hemiLight);

var dirLight = new THREE.DirectionalLight(0xffffff, 0.54);
dirLight.position.set(0, 1, 0);
dirLight.castShadow = true;
dirLight.shadow.mapSize = new THREE.Vector2(1024, 1024);
// Add directional Light to scene
scene.add(dirLight);



// Floor
var floorGeometry = new THREE.PlaneGeometry(5000, 5000, 1, 1);
var floorMaterial = new THREE.MeshPhongMaterial({
  color: 0xeeeeee,
  shininess: 0 });


var floor = new THREE.Mesh(floorGeometry, floorMaterial);
floor.rotation.x = -0.5 * Math.PI;
floor.receiveShadow = true;
floor.position.y = -3.5;
scene.add(floor);

// Add controls
var controls = new THREE.OrbitControls(camera, renderer.domElement);
controls.maxPolarAngle = Math.PI / 2;
controls.minPolarAngle = Math.PI / 3;
controls.enableDamping = true;
controls.enablePan = false;
controls.dampingFactor = 0.1;
controls.autoRotate = false; // Toggle this if you'd like the chair to automatically rotate
controls.autoRotateSpeed = 0.2; // 30

function animate() {

  controls.update();
  renderer.render(scene, camera);
  requestAnimationFrame(animate);

  if (resizeRendererToDisplaySize(renderer)) {
    const canvas = renderer.domElement;
    camera.aspect = canvas.clientWidth / canvas.clientHeight;
    camera.updateProjectionMatrix();
  }

  if (theModel != null && loaded == false) {
    initialRotation();
    DRAG_NOTICE.classList.add('start');
  }
}

animate();

// Function - New resizing method
function resizeRendererToDisplaySize(renderer) {
  const canvas = renderer.domElement;
  var width = window.innerWidth;
  var height = window.innerHeight;
  var canvasPixelWidth = canvas.width / window.devicePixelRatio;
  var canvasPixelHeight = canvas.height / window.devicePixelRatio;

  const needResize = canvasPixelWidth !== width || canvasPixelHeight !== height;
  if (needResize) {

    renderer.setSize(width, 1000, false);
  }
  return needResize;
}

function updateColors(objec) {
  buildColors(colors, objec);
  for (let i = 0; i < COLOR_TRAYS.length; i++) {
    COLOR_TRAYS[i].addEventListener('click', buildingColors);
  }
}

var color_tray_id;

function buildingColors() {
  elem = document.getElementsByClassName('tray_color_slide')[0];
  elem.innerHTML = '<button>Click to see color swatches</button>';
  elem.classList.remove('tray_color_slide');
  buildColors(colors, this);
}

// Function - Build Colors
function buildColors(colors, obj) {
  obj.innerHTML = '';
    for (let [i, color] of colors.entries()) {
      let swatch = document.createElement('div');
      swatch.classList.add('tray__swatch');

      swatch.style.background = "#" + color.color;
      swatch.setAttribute('data-key', i);
      obj.append(swatch);
      obj.classList.add('tray_color_slide');
    }

    // Swatches
    const SWATCHES = document.querySelectorAll(".tray__swatch");

    for (const SWATCH of SWATCHES) {
      SWATCH.addEventListener('click', selectSwatch);
    }

    let sliderItems = obj, difference;
    slide(slider, sliderItems);

    color_tray_id = obj.id;
}

function generateTextures() {
  let texturesLength = 10;
  let textures = [];
  for (let i = 1; i < texturesLength || i == texturesLength; i++) {
    singleTexture = {
      texture: ABSURL + "/build-kit/textures/fabric" + i + ".jpg",
      size: [2, 2, 2],
      shininess: 100
    };
    textures.push(singleTexture);
  }
  return textures;
}

function buildTextures(textures) {
  for (let [i, texture] of textures.entries()) {
    let swatch = document.createElement('div');
    swatch.classList.add('tray__texture');

      swatch.style.backgroundImage = "url(" + texture.texture + ")";

    swatch.setAttribute('data-key', i);
    TEXTURE_TRAY.append(swatch);
  }

  let slider = document.getElementsByClassName('tray1')[0], sliderItems = document.getElementById('texture'), difference;
  slide(slider, sliderItems);
}

textures = generateTextures();
buildTextures(textures);
updateColors(document.getElementsByClassName('tray_color_slide')[0]);



// Select Option
const options = document.querySelectorAll(".option");

for (const option of options) {
  option.addEventListener('click', selectOption);
}

function selectOption(e) {
  let option = e.target;
  activeOption = e.target.dataset.option;
  for (const otherOption of options) {
    otherOption.classList.remove('--is-active');
  }
  option.classList.add('--is-active');
}


const textures_ = document.querySelectorAll(".tray__texture");


for (const texture_ of textures_) {

  texture_.addEventListener('click', selectTextures);
}

function selectTextures(e) {
  let texture = textures[parseInt(e.target.dataset.key)];
  let new_mtl;

    let txt = new THREE.TextureLoader().load(texture.texture);

    txt.repeat.set(texture.size[0], texture.size[1], texture.size[2]);
    txt.wrapS = THREE.RepeatWrapping;
    txt.wrapT = THREE.RepeatWrapping;

    new_mtl = new THREE.MeshPhongMaterial({
      map: txt,
      shininess: texture.shininess ? texture.shininess : 10 });

   for (let part of window[activeOption]) {
    alert(part);
      setMaterial(theModel, part, new_mtl);
    }
}

function selectSwatch(e) {
  let color = colors[parseInt(e.target.dataset.key)];
  let new_mtl;

 new_mtl = new THREE.MeshPhongMaterial({
      color: parseInt('0x' + color.color),
      shininess: color.shininess ? color.shininess : 10 });
  //The color tray id indicates the part being customized
  setMaterial(theModel, window[activeOption][color_tray_id], new_mtl);
}

function setMaterial(parent, type, mtl) {
  parent.traverse(o => {
    if (o.isMesh && o.nameID != null) {
      if (o.nameID == type) {
        o.material = mtl;
      }
    }
  });
}

// Function - Opening rotate
let initRotate = 0;

function initialRotation() {
  initRotate++;
  if (initRotate <= 120) {
    theModel.rotation.y += Math.PI / 60;
  } else {
    loaded = true;
  }
}

var slider = document.getElementsByClassName('tray')[0];

function slide(wrapper, items) {
  var posX1 = 0,
  posX2 = 0,
  posInitial,
  threshold = 20,
  posFinal,
  slides = items.getElementsByClassName('tray__swatch');

  // Mouse events
  items.onmousedown = dragStart;

  // Touch events
  items.addEventListener('touchstart', dragStart);
  items.addEventListener('touchend', dragEnd);
  items.addEventListener('touchmove', dragAction);


  function dragStart(e) {
    e = e || window.event;
    posInitial = items.offsetLeft;
    difference = items.offsetWidth - wrapper.offsetWidth;
    difference = difference * -1;

    if (e.type == 'touchstart') {
      posX1 = e.touches[0].clientX;
    } else {
      posX1 = e.clientX;
      document.onmouseup = dragEnd;
      document.onmousemove = dragAction;
    }
  }

  function dragAction(e) {
    e = e || window.event;

    if (e.type == 'touchmove') {
      posX2 = posX1 - e.touches[0].clientX;
      posX1 = e.touches[0].clientX;
    } else {
      posX2 = posX1 - e.clientX;
      posX1 = e.clientX;
    }

    if (items.offsetLeft - posX2 <= 0 && items.offsetLeft - posX2 >= difference) {
      items.style.left = items.offsetLeft - posX2 + "px";
    }
  }

  function dragEnd(e) {
    posFinal = items.offsetLeft;
    if (posFinal - posInitial < -threshold) {

    } else if (posFinal - posInitial > threshold) {

    } else {
      items.style.left = posInitial + "px";
    }

    document.onmouseup = null;
    document.onmousemove = null;
  }

}


function takeScreenshot() {
  // For screenshots to work with WebGL renderer, preserveDrawingBuffer should be set to true.
  // open in new window like this
  var w = window.open('', '');
  w.document.title = "Screenshot";
  //w.document.body.style.backgroundColor = "red";
  var img = new Image();
  img.src = renderer.domElement.toDataURL();
  img.width = 500;
  w.document.body.appendChild(img);

  // download file like this.
  //var a = document.createElement('a');
  //a.href = renderer.domElement.toDataURL().replace("image/png", "image/octet-stream");
  //a.download = 'canvas.png'
  //a.click();
}

function downloadModelImage() {
  var a = document.createElement('a');
  a.href = renderer.domElement.toDataURL().replace("image/png", "image/octet-stream");
  a.download = 'my customized product.png';
  a.click();
}

function saveModelImageToServer() {
  dataURL = renderer.domElement.toDataURL();
  $.ajax({
    type: "POST",
    url: "script.php",
    data: {
      imgBase64: dataURL
    }
  }).done(function (o) {
    console.log('saved');
  });
}

document.getElementById('view-image').addEventListener('click', takeScreenshot);

document.getElementById('download-image').addEventListener('click', downloadModelImage);

document.getElementById('add-to-cart').addEventListener('click', saveModelImageToServer);

window.onload = (e) => {
  setTimeout((e) => {
    document.getElementById('info__message').style.cssText = 'display: none;';
  }, 50000);
}

function showActions() {
  setTimeout((e) => {
    document.getElementById('call-to-actions').style.cssText = 'display: block;';
  }, 5000)
}

canvasWrapper = document.getElementById('canvas-wrapper');
canvasWrapper.addEventListener('scroll', showActions);
canvasWrapper.addEventListener('click', showActions);