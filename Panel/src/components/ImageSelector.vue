<template>

  <div class="va-file-upload va-file-upload--dropzone" style="background-color: rgba(21, 79, 193, 0.08);">
    <div class="va-file-upload__field" @click="new_file">
      <div class="va-file-upload__field__text"> Drag’n’drop files or</div>
      <button class="va-button va-button--default va-button--normal va-file-upload__field__button" type="button"
              tabindex="0" style="color: rgb(255, 255, 255); background: rgb(21, 78, 193);">
        <div class="va-button__content"><!--v-if--> Upload file <!--v-if--></div><!--v-if--></button>
      <div v-if="loading">

        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             style="margin:auto;background:#fff;display:block;" width="200px" height="200px" viewBox="0 0 100 100"
             preserveAspectRatio="xMidYMid">
          <circle cx="50" cy="50" r="32" stroke-width="8" stroke="#e15b64"
                  stroke-dasharray="50.26548245743669 50.26548245743669" fill="none" stroke-linecap="round">
            <animateTransform attributeName="transform" type="rotate" dur="1s" repeatCount="indefinite" keyTimes="0;1"
                              values="0 50 50;360 50 50"></animateTransform>
          </circle>
          <circle cx="50" cy="50" r="23" stroke-width="8" stroke="#f8b26a"
                  stroke-dasharray="36.12831551628262 36.12831551628262" stroke-dashoffset="36.12831551628262"
                  fill="none" stroke-linecap="round">
            <animateTransform attributeName="transform" type="rotate" dur="1s" repeatCount="indefinite" keyTimes="0;1"
                              values="0 50 50;-360 50 50"></animateTransform>
          </circle>
        </svg>


      </div>
    </div>
    <div class="va-file-upload-list va-file-upload-list--gallery" v-if="!props.one_file"><!--v-if-->
      <div class="va-file-upload-gallery-item" v-for="(file , index) in files">
        <img
          :src="file.full_path"
          alt="" class="va-file-upload-gallery-item__image">
        <div class="va-file-upload-gallery-item__overlay" style="background-color: rgba(21, 78, 193, 0.7);">
          <div class="va-file-upload-gallery-item__name" title="WhatsApp Image 2023-07-15 at 10.39.18.jpeg">WhatsApp
            Image 2023-07-15 at 10.39.18.jpeg
          </div>
          <i class="va-file-upload-gallery-item__delete va-icon material-icons va-file-upload-gallery-item__delete" @click="delete_file(index)"
             aria-hidden="true" notranslate="" style="cursor: pointer; color: rgb(228, 34, 34); font-size: 19px;">delete_outline</i>
        </div>
      </div>
    </div>
    <div class="va-file-upload-list va-file-upload-list--gallery" v-if="props.one_file"><!--v-if-->
      <div class="va-file-upload-gallery-item">
        <img
          :src="model.logo"
          alt="" class="va-file-upload-gallery-item__image">
        <div class="va-file-upload-gallery-item__overlay" style="background-color: rgba(21, 78, 193, 0.7);">
          <div class="va-file-upload-gallery-item__name" title="WhatsApp Image 2023-07-15 at 10.39.18.jpeg">WhatsApp
            Image 2023-07-15 at 10.39.18.jpeg
          </div>
          <i class="va-file-upload-gallery-item__delete va-icon material-icons va-file-upload-gallery-item__delete" @click="delete_file(index)"
             aria-hidden="true" notranslate="" style="cursor: pointer; color: rgb(228, 34, 34); font-size: 19px;">delete_outline</i>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>
import {toRefs, ref} from 'vue';

const props = defineProps(['files', 'api', 'model', 'one_file'])
const {model, files} = toRefs(props);


function new_file() {

  var input = document.createElement('input');
  input.type = 'file';
  input.multiple = true;

  input.onchange = e => {
    loading.value = true;
    let formData = new FormData();
    [].slice.call(e.target.files).forEach((selected_file) => {
      formData.append("files[]", selected_file);
    })
    fetch(props.api, {method: "POST", body: formData})
      .then(function (response) {
        if (response.status !== 200) {
          throw response.status;
        } else {
          return response.json();
        }
      })
      .then(function (data) {
        data.files.forEach((uploaded_file) => {
          if (props.one_file) {
            model.value.logo = uploaded_file.full_path;
          } else {
            files.value.push(uploaded_file)
          }
        })
        loading.value = false;
      });

  }

  input.click();

}

function delete_file(index) {
  files.value.splice(index, 1);
}

const loading = ref(false);

</script>
<style scoped>
.card .btn-remove {
  position: absolute;
  left: calc(50% - 15px);
  top: calc(50% - 15px);
  display: none;
}

.image-box:hover .btn-remove {
  display: block;
}

.image-box:hover img {
  display: block;
  filter: blur(3px);
}

.upload-icon {
  margin-left: 22px;
  font-size: 40px;
  color: mediumseagreen;
  cursor: pointer;
}

@-webkit-keyframes outerRotate1 {
  0% {
    transform: translate(-50%, -50%) rotate(0);
  }
  100% {
    transform: translate(-50%, -50%) rotate(360deg);
  }
}

@-moz-keyframes outerRotate1 {
  0% {
    transform: translate(-50%, -50%) rotate(0);
  }
  100% {
    transform: translate(-50%, -50%) rotate(360deg);
  }
}

@-o-keyframes outerRotate1 {
  0% {
    transform: translate(-50%, -50%) rotate(0);
  }
  100% {
    transform: translate(-50%, -50%) rotate(360deg);
  }
}

@keyframes outerRotate1 {
  0% {
    transform: translate(-50%, -50%) rotate(0);
  }
  100% {
    transform: translate(-50%, -50%) rotate(360deg);
  }
}

@-webkit-keyframes outerRotate2 {
  0% {
    transform: translate(-50%, -50%) rotate(0);
  }
  100% {
    transform: translate(-50%, -50%) rotate(-360deg);
  }
}

@-moz-keyframes outerRotate2 {
  0% {
    transform: translate(-50%, -50%) rotate(0);
  }
  100% {
    transform: translate(-50%, -50%) rotate(-360deg);
  }
}

@-o-keyframes outerRotate2 {
  0% {
    transform: translate(-50%, -50%) rotate(0);
  }
  100% {
    transform: translate(-50%, -50%) rotate(-360deg);
  }
}

@keyframes outerRotate2 {
  0% {
    transform: translate(-50%, -50%) rotate(0);
  }
  100% {
    transform: translate(-50%, -50%) rotate(-360deg);
  }
}

@-webkit-keyframes textColour {
  0% {
    color: #fff;
  }
  100% {
    color: #3BB2D0;
  }
}

@-moz-keyframes textColour {
  0% {
    color: #fff;
  }
  100% {
    color: #3BB2D0;
  }
}

@-o-keyframes textColour {
  0% {
    color: #fff;
  }
  100% {
    color: #3BB2D0;
  }
}

@keyframes textColour {
  0% {
    color: #fff;
  }
  100% {
    color: #3BB2D0;
  }
}

#loading {
  margin: 0;
  padding: 0;
  font-family: "Open Sans", sans-serif;
  height: 100vh;
  background: #222;
}

.e-loadholder {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-51%, -50%);
  -moz-transform: translate(-51%, -50%);
  -ms-transform: translate(-51%, -50%);
  -o-transform: translate(-51%, -50%);
  transform: translate(-51%, -50%);
  width: 240px;
  height: 240px;
  border: 5px solid #1B5F70;
  border-radius: 120px;
  box-sizing: border-box;
}

.e-loadholder:after {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-51%, -50%);
  -moz-transform: translate(-51%, -50%);
  -ms-transform: translate(-51%, -50%);
  -o-transform: translate(-51%, -50%);
  transform: translate(-51%, -50%);
  content: " ";
  display: block;
  background: #222;
  transform-origin: center;
  z-index: 555;
}

.e-loadholder:after {
  width: 100px;
  height: 200%;
  -webkit-animation: outerRotate2 30s infinite linear;
  -moz-animation: outerRotate2 30s infinite linear;
  -o-animation: outerRotate2 30s infinite linear;
  animation: outerRotate2 30s infinite linear;
}

.e-loadholder .m-loader {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-51%, -50%);
  -moz-transform: translate(-51%, -50%);
  -ms-transform: translate(-51%, -50%);
  -o-transform: translate(-51%, -50%);
  transform: translate(-51%, -50%);
  width: 200px;
  height: 200px;
  color: #888;
  text-align: center;
  border: 5px solid #2a93ae;
  border-radius: 100px;
  box-sizing: border-box;
  z-index: 55555;
  text-transform: uppercase;
}

.e-loadholder .m-loader:after {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-51%, -50%);
  -moz-transform: translate(-51%, -50%);
  -ms-transform: translate(-51%, -50%);
  -o-transform: translate(-51%, -50%);
  transform: translate(-51%, -50%);
  content: " ";
  display: block;
  background: #222;
  transform-origin: center;
  z-index: -1;
}

.e-loadholder .m-loader:after {
  width: 100px;
  height: 106%;
  -webkit-animation: outerRotate1 15s infinite linear;
  -moz-animation: outerRotate1 15s infinite linear;
  -o-animation: outerRotate1 15s infinite linear;
  animation: outerRotate1 15s infinite linear;
}

.e-loadholder .m-loader .e-text {
  font-size: 14px;
  font-size: 1.4rem;
  line-height: 130px;
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-51%, -50%);
  -moz-transform: translate(-51%, -50%);
  -ms-transform: translate(-51%, -50%);
  -o-transform: translate(-51%, -50%);
  transform: translate(-51%, -50%);
  -webkit-animation: textColour 1s alternate linear infinite;
  -moz-animation: textColour 1s alternate linear infinite;
  -o-animation: textColour 1s alternate linear infinite;
  animation: textColour 1s alternate linear infinite;
  display: block;
  width: 140px;
  height: 140px;
  text-align: center;
  border: 5px solid #3bb2d0;
  border-radius: 70px;
  box-sizing: border-box;
  z-index: 55555;
}

.e-loadholder .m-loader .e-text:before, .e-loadholder .m-loader .e-text:after {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-51%, -50%);
  -moz-transform: translate(-51%, -50%);
  -ms-transform: translate(-51%, -50%);
  -o-transform: translate(-51%, -50%);
  transform: translate(-51%, -50%);
  content: " ";
  display: block;
  background: #222;
  transform-origin: center;
  z-index: -1;
}

.e-loadholder .m-loader .e-text:before {
  width: 110%;
  height: 40px;
  -webkit-animation: outerRotate2 3.5s infinite linear;
  -moz-animation: outerRotate2 3.5s infinite linear;
  -o-animation: outerRotate2 3.5s infinite linear;
  animation: outerRotate2 3.5s infinite linear;
}

.e-loadholder .m-loader .e-text:after {
  width: 40px;
  height: 110%;
  -webkit-animation: outerRotate1 8s infinite linear;
  -moz-animation: outerRotate1 8s infinite linear;
  -o-animation: outerRotate1 8s infinite linear;
  animation: outerRotate1 8s infinite linear;
}

#particleCanvas-White {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-51%, -50%);
  -moz-transform: translate(-51%, -50%);
  -ms-transform: translate(-51%, -50%);
  -o-transform: translate(-51%, -50%);
  transform: translate(-51%, -50%);
  width: 90%;
  height: 50%;
  opacity: 0.1;
}

#particleCanvas-Blue {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-51%, -50%);
  -moz-transform: translate(-51%, -50%);
  -ms-transform: translate(-51%, -50%);
  -o-transform: translate(-51%, -50%);
  transform: translate(-51%, -50%);
  width: 300px;
  height: 300px;
}
</style>
