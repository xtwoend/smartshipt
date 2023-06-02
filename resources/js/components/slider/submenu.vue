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
            <a :href="`/fleet/${fleet.id}`" class="submenu-item" :class="{'active': (active == 'info')}">INFO</a>
        </swiper-slide>
        <swiper-slide>
            <a :href="`/fleet/${fleet.id}/trend`" class="submenu-item" :class="{'active': (active == 'trend')}">TREND</a>
        </swiper-slide>
        <swiper-slide>
            <a :href="`/fleet/${fleet.id}/notes`" class="submenu-item" :class="{'active': (active == 'notes')}">NOTES</a>
        </swiper-slide>
        <swiper-slide>
            <a :href="`/fleet/${fleet.id}/docs`" class="submenu-item" :class="{'active': (active == 'docs')}">DOCUMENTS</a>
        </swiper-slide>
        <swiper-slide>
            <a :href="`/fleet/${fleet.id}/reports`" class="submenu-item" :class="{'active': (active == 'reports')}">REPORTS</a>
        </swiper-slide>
        <swiper-slide>
            <a :href="`/fleet/${fleet.id}/diagnotics`" class="submenu-item" :class="{'active': (active == 'diagnotics')}">DIAGNOSTICS</a>
        </swiper-slide>
        <swiper-slide>
            <a :href="`/fleet/${fleet.id}/alarms`" class="submenu-item" :class="{'active': (active == 'alarms')}">NOTIFICATIONS</a>
        </swiper-slide>
        <swiper-slide>
            <a :href="`/fleet/${fleet.id}/emision`" class="submenu-item" :class="{'active': (active == 'emision')}">EMISION REPORT</a>
        </swiper-slide>
        <swiper-slide>
            <a :href="`/fleet/${fleet.id}/charter`"  class="submenu-item" :class="{'active': (active == 'charter')}">CHARTER</a>
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
      props: {
        fleet: Object,
        active: String
      },
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
          auto: true,
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