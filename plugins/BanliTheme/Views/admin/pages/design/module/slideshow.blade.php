<template id="module-editor-slideshow-template">
  <div>
    <module-size v-model="module.module_size"></module-size>

    <div class="module-editor-row">{{ __('admin/builder.modules_content') }}</div>
    <div class="module-edit-group">
      <div class="module-edit-title">{{ __('admin/builder.modules_select_image') }}</div>
      <draggable
        ghost-class="dragabble-ghost"
        :list="module.images"
        :options="{animation: 330, handle: '.icon-rank'}"
      >
        <div class="pb-images-selector" v-for="(item, index) in module.images" :key="index">
          <div class="selector-head" @click="itemShow(index)">
            <div class="left">
              <el-tooltip class="icon-rank" effect="dark" content="{{ __('admin/builder.text_drag_sort') }}" placement="left">
                <i class="el-icon-rank"></i>
              </el-tooltip>

              <img :src="thumbnail(item.image?.src?.['{{ locale() }}'] || item.image?.src || item.image, 40, 40)" class="img-responsive">
            </div>

            <div class="right">
              <el-tooltip class="" effect="dark" content="{{ __('admin/builder.text_delete') }}" placement="left">
                <div class="remove-item" @click.stop="removeImage(index)"><i class="el-icon-delete"></i></div>
              </el-tooltip>
              <i :class="'el-icon-arrow-'+(item.show ? 'up' : 'down')"></i>
            </div>
          </div>
          <div :class="'pb-images-list ' + (item.show ? 'active' : '')">
            <div class="pb-images-top">
              <pb-image-selector :is-alt="true"  v-model="item.image"></pb-image-selector>
              <div class="tag">{{ __('admin/builder.text_suggested_size') }} 1920 x 600</div>
            </div>
            <link-selector v-model="item.link"></link-selector>

            <div class="module-edit-title mt-3">Background Video (Optional)</div>
            <pb-image-selector :is-alt="false" :is-video="true" v-model="item.video"></pb-image-selector>
            <div class="tag">Upload a small mp4 video or select an existing one.</div>

            <!-- Additional fields for Cyber Hero -->
            <div class="module-edit-title mt-3">Title</div>
            <text-i18n v-model="item.title" style="margin-bottom: 10px"></text-i18n>
            
            <div class="module-edit-title mt-3">Sub Title</div>
            <text-i18n v-model="item.sub_title" style="margin-bottom: 10px"></text-i18n>

            <div class="module-edit-title mt-3">Date</div>
            <text-i18n v-model="item.date" style="margin-bottom: 10px"></text-i18n>

            <div class="module-edit-title mt-3">Location</div>
            <text-i18n v-model="item.location" style="margin-bottom: 10px"></text-i18n>

            <div class="module-edit-title mt-3">Button 1 Text</div>
            <text-i18n v-model="item.btn1_text" style="margin-bottom: 10px"></text-i18n>

            <div class="module-edit-title mt-3">Button 2 Text</div>
            <text-i18n v-model="item.btn2_text" style="margin-bottom: 10px"></text-i18n>

            <div class="module-edit-title mt-3">Button 2 Link</div>
            <el-input v-model="item.btn2_link" style="margin-bottom: 10px"></el-input>

            <div class="module-edit-title mt-3">Countdown Title</div>
            <text-i18n v-model="item.countdown_title" style="margin-bottom: 10px"></text-i18n>

            <div class="module-edit-title mt-3">Countdown Sub Title</div>
            <text-i18n v-model="item.countdown_sub_title" style="margin-bottom: 10px"></text-i18n>

            <div class="module-edit-title mt-3">Countdown Target Date</div>
            <el-input v-model="item.countdown_date" placeholder="e.g., 2026-10-01 08:00:00" style="margin-bottom: 10px"></el-input>

            <div class="module-edit-title mt-3">Countdown Address</div>
            <text-i18n v-model="item.countdown_address" style="margin-bottom: 10px"></text-i18n>
          </div>
        </div>
      </draggable>

      <div class="add-item">
        <el-button type="primary" size="small" @click="addImage" icon="el-icon-circle-plus-outline">{{ __('admin/builder.text_add_pictures') }}</el-button>
      </div>
    </div>
  </div>
</template>

<script type="text/javascript">

Vue.component('module-editor-slideshow', {
  template: '#module-editor-slideshow-template',

  props: ['module'],

  data: function () {
    return {
    }
  },

  watch: {
    module: {
      handler: function (val) {
        this.$emit('on-changed', val);
      },
      deep: true,
    }
  },

  created: function () {
    if (this.module.images && this.module.images.length > 0) {
        for (let i = 0; i < this.module.images.length; i++) {
            if (typeof this.module.images[i].title === 'undefined' || this.module.images[i].title === null) {
                this.$set(this.module.images[i], 'title', languagesFill(''));
            }
            if (typeof this.module.images[i].sub_title === 'undefined' || this.module.images[i].sub_title === null) {
                this.$set(this.module.images[i], 'sub_title', languagesFill(''));
            }
            if (typeof this.module.images[i].date === 'undefined' || this.module.images[i].date === null) {
                this.$set(this.module.images[i], 'date', languagesFill(''));
            }
            if (typeof this.module.images[i].location === 'undefined' || this.module.images[i].location === null) {
                this.$set(this.module.images[i], 'location', languagesFill(''));
            }
            if (typeof this.module.images[i].btn1_text === 'undefined' || this.module.images[i].btn1_text === null) {
                this.$set(this.module.images[i], 'btn1_text', languagesFill(''));
            }
            if (typeof this.module.images[i].btn2_text === 'undefined' || this.module.images[i].btn2_text === null) {
                this.$set(this.module.images[i], 'btn2_text', languagesFill(''));
            }
            if (typeof this.module.images[i].btn2_link === 'undefined' || this.module.images[i].btn2_link === null) {
                this.$set(this.module.images[i], 'btn2_link', '');
            }
            if (typeof this.module.images[i].countdown_title === 'undefined' || this.module.images[i].countdown_title === null) {
                this.$set(this.module.images[i], 'countdown_title', languagesFill(''));
            }
            if (typeof this.module.images[i].countdown_sub_title === 'undefined' || this.module.images[i].countdown_sub_title === null) {
                this.$set(this.module.images[i], 'countdown_sub_title', languagesFill(''));
            }
            if (typeof this.module.images[i].countdown_date === 'undefined' || this.module.images[i].countdown_date === null) {
                this.$set(this.module.images[i], 'countdown_date', '2026-10-01 08:00:00');
            }
            if (typeof this.module.images[i].countdown_address === 'undefined' || this.module.images[i].countdown_address === null) {
                this.$set(this.module.images[i], 'countdown_address', languagesFill(''));
            }
            if (typeof this.module.images[i].video === 'undefined' || this.module.images[i].video === null || typeof this.module.images[i].video === 'string') {
                this.$set(this.module.images[i], 'video', {
                  src: languagesFill(this.module.images[i].video || ''),
                  alt: languagesFill(''),
                });
            }
        }
    }
  },

  methods: {
    removeImage(index) {
      this.module.images.splice(index, 1);
    },

    itemShow(index) {
      this.module.images.find((e, key) => {if (index != key) return e.show = false});
      this.module.images[index].show = !this.module.images[index].show;
    },

    addImage() {
      this.module.images.find(e => e.show = false);
      this.module.images.push({
        image: {
          src: languagesFill('image/catalog/demo/banner/banner-4-en.jpg'),
          alt: languagesFill(''),
        }, 
        show: true, 
        link: {type: 'product', value:''},
        title: languagesFill(''),
        sub_title: languagesFill(''),
        date: languagesFill(''),
        location: languagesFill(''),
        btn1_text: languagesFill(''),
        btn2_text: languagesFill(''),
        btn2_link: '',
        countdown_title: languagesFill(''),
        countdown_sub_title: languagesFill(''),
        countdown_date: '2026-10-01 08:00:00',
        countdown_address: languagesFill(''),
        video: {
          src: languagesFill(''),
          alt: languagesFill(''),
        }
      });
    }
  }
});

</script>

@push('footer-script')
  <script>
    register = @json($register);

    // 定义模块的配置项
    register.make = {
      style: {
        background_color: ''
      },
      floor: languagesFill(''),
      module_size: 'w-100',// 窄屏、宽屏、全屏
      images: [
        {
          image: {
            src: languagesFill('image/catalog/demo/banner/banner-4-en.jpg'),
            alt: languagesFill(''),
          },
          show: true,
          link: {
            type: 'product',
            value:''
          },
          title: languagesFill('AI Summit 2026'),
          sub_title: languagesFill('The Future of Intelligence'),
          date: languagesFill('October 1–5, 2026'),
          location: languagesFill('San Francisco, CA'),
          btn1_text: languagesFill('Get Tickets'),
          btn2_text: languagesFill('View Schedule'),
          btn2_link: '#section-schedule',
          countdown_title: languagesFill('Hurry Up!'),
          countdown_sub_title: languagesFill('Book Your Seat Now'),
          countdown_date: '2026-10-01 08:00:00',
          countdown_address: languagesFill("121 AI Blvd,\nSan Francisco BCA 94107"),
          video: {
            src: languagesFill('image/catalog/banli_theme/cyber-bg-2.mp4'),
            alt: languagesFill('')
          }
        },
        {
          image: {
            src: languagesFill('image/catalog/demo/banner/banner-3-en.jpg'),
            alt: languagesFill(''),
          },
          show: false,
          link: {
            type: 'product',
            value:''
          },
          title: languagesFill(''),
          sub_title: languagesFill(''),
          date: languagesFill(''),
          location: languagesFill(''),
          btn1_text: languagesFill(''),
          btn2_text: languagesFill(''),
          btn2_link: '',
          countdown_title: languagesFill(''),
          countdown_sub_title: languagesFill(''),
          countdown_date: '2026-10-01 08:00:00',
          countdown_address: languagesFill(''),
          video: {
            src: languagesFill(''),
            alt: languagesFill('')
          }
        }
      ]
    }

    app.source.modules.push(register)
  </script>
@endpush