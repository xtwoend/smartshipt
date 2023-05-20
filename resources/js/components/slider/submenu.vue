<template>
    <swiper
      :slides-per-view="auto"
      :space-between="0"
      :navigation="{
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  }"
      @swiper="onSwiper"
      @slideChange="onSlideChange"
    >
        <div class="swiper-button-prev">
            <img :src="'/img/icons/chevron-prev.png'" alt="" />
        </div>
        <swiper-slide>
            <a href="#" class="submenu-item active">INFO</a>
        </swiper-slide>
        <swiper-slide>
            <a href="#" class="submenu-item">TREND</a>
        </swiper-slide>
        <swiper-slide>
            <a href="#" class="submenu-item">NOTES</a>
        </swiper-slide>
        <swiper-slide>
            <a href="#" class="submenu-item">DOCUMENTS</a>
        </swiper-slide>
        <swiper-slide>
            <a href="#" class="submenu-item">REPORTS</a>
        </swiper-slide>
        <swiper-slide>
            <a href="#" class="submenu-item">DIAGNOSTICS</a>
        </swiper-slide>
        <swiper-slide>
            <a href="#" class="submenu-item">NOTIFICATIONS</a>
        </swiper-slide>
        <swiper-slide>
            <a href="#" class="submenu-item">EMISION REPORT</a>
        </swiper-slide>
        <swiper-slide>
            <a href="#" class="submenu-item">CHARTER</a>
        </swiper-slide>
        <div class="swiper-button-next">
            <img :src="'/img/icons/chevron-next.png'" alt="" />
        </div>
    </swiper>
  </template>
  <script>
    import { Navigation, A11y } from 'swiper';

    // Import Swiper Vue.js components
    import { Swiper, SwiperSlide } from 'swiper/vue';
  
    // Import Swiper styles
    import 'swiper/scss';
    import 'swiper/scss/navigation';
  
    export default {
      components: {
        Swiper,
        SwiperSlide,
      },
      setup() {
        const onSwiper = (swiper) => {
          console.log(swiper);
        };
        const onSlideChange = () => {
          console.log('slide change');
        };
        return {
          onSwiper,
          onSlideChange,
          modules: [Navigation, A11y],
        };
      },
    };
  </script>

  <style lang="scss">
    .swiper{
        background: #2C74B3;
        border-radius: 8px;
        .swiper-wrapper{
            padding-left: 3em;
            .swiper-slide{
                width: auto!important;

                a{
                    padding: 1em;
                    display: inline-block;
                    background: #2C74B3;
                    color: #fff;

                    &:hover{
                        background: #488dc9;
                    }
                }
                a.active{
                    background: #488dc9;
                }
            }
        }
    }
</style>