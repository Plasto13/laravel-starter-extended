(window["aioseopjsonp"]=window["aioseopjsonp"]||[]).push([["local-seo-pro-MultipleLocationsSettings-vue"],{d8a3:function(s,e,t){"use strict";t.r(e);var o=function(){var s=this,e=s.$createElement,t=s._self._c||e;return t("div",{staticClass:"aioseo-locations aioseo-locations-multiple-locations-settings"},[s.options.localBusiness.locations.general.multiple&&s.$aioseo.license.isActive?t("core-card",{attrs:{slug:"advancedLocationsSettings","header-text":s.strings.advancedLocationsSettings}},[t("core-settings-row",{staticClass:"location-permalink",attrs:{name:s.strings.locationsPermalink},scopedSlots:s._u([{key:"content",fn:function(){return[t("div",{staticClass:"location-permalink-preview"},[t("span",{staticClass:"baseurl"},[s._v(s._s(s.$aioseo.urls.mainSiteUrl)+"/")]),s._l(s.$aioseo.localBusiness.postTypePermalinkStructure,(function(e,o){return t("span",{key:o,class:"{slug}"==e?"slug":""},[s._v(s._s("{slug}"==e?s.currentPostTypeSlug:e))])}))],2),t("base-checkbox",{attrs:{size:"medium"},model:{value:s.options.localBusiness.locations.general.useCustomSlug,callback:function(e){s.$set(s.options.localBusiness.locations.general,"useCustomSlug",e)},expression:"options.localBusiness.locations.general.useCustomSlug"}},[s._v(" "+s._s(s.strings.useCustomSlug)+" ")]),s.options.localBusiness.locations.general.useCustomSlug?t("base-input",{staticClass:"custom-slug",class:{"aioseo-error":!s.validCustomSlug},attrs:{spellcheck:!1},on:{input:function(e){return s.validateCustomSlug(e)}},model:{value:s.options.localBusiness.locations.general.customSlug,callback:function(e){s.$set(s.options.localBusiness.locations.general,"customSlug",e)},expression:"options.localBusiness.locations.general.customSlug"}}):s._e(),s.options.localBusiness.locations.general.useCustomSlug&&!s.validCustomSlug?t("div",{staticClass:"aioseo-description aioseo-error"},[s._v(" "+s._s(s.strings.invalidCustomSlug)+" ")]):s._e()]},proxy:!0}],null,!1,4281210992)}),t("core-settings-row",{staticClass:"location-category-permalink",attrs:{name:s.strings.locationsCategoryPermalink},scopedSlots:s._u([{key:"content",fn:function(){return[t("div",{staticClass:"location-permalink-preview location-category-permalink-preview"},[t("span",{staticClass:"baseurl"},[s._v(s._s(s.$aioseo.urls.mainSiteUrl)+"/")]),s._l(s.$aioseo.localBusiness.taxonomyPermalinkStructure,(function(e,o){return t("span",{key:o,class:"{slug}"==e?"slug":""},[s._v(s._s("{slug}"==e?s.currentTaxonomySlug:e))])}))],2),t("base-checkbox",{attrs:{size:"medium"},model:{value:s.options.localBusiness.locations.general.useCustomCategorySlug,callback:function(e){s.$set(s.options.localBusiness.locations.general,"useCustomCategorySlug",e)},expression:"options.localBusiness.locations.general.useCustomCategorySlug"}},[s._v(" "+s._s(s.strings.useCustomCategorySlug)+" ")]),s.options.localBusiness.locations.general.useCustomCategorySlug?t("base-input",{staticClass:"custom-slug",class:{"aioseo-error":!s.validCustomCategorySlug},attrs:{spellcheck:!1},on:{input:function(e){return s.validateCustomCategorySlug(e)}},model:{value:s.options.localBusiness.locations.general.customCategorySlug,callback:function(e){s.$set(s.options.localBusiness.locations.general,"customCategorySlug",e)},expression:"options.localBusiness.locations.general.customCategorySlug"}}):s._e(),s.options.localBusiness.locations.general.useCustomCategorySlug&&!s.validCustomCategorySlug?t("div",{staticClass:"aioseo-description aioseo-error"},[s._v(" "+s._s(s.strings.invalidCustomSlug)+" ")]):s._e()]},proxy:!0}],null,!1,681061009)}),t("core-settings-row",{staticClass:"location-enhanced-search",attrs:{name:s.strings.enhancedSearch},scopedSlots:s._u([{key:"content",fn:function(){return[t("base-radio-toggle",{attrs:{name:"enhancedSearch",disabled:!s.$aioseo.localBusiness.enhancedSearchTest,options:[{label:s.$constants.GLOBAL_STRINGS.off,value:!1,activeClass:"dark"},{label:s.$constants.GLOBAL_STRINGS.on,value:!0}]},model:{value:s.options.localBusiness.locations.general.enhancedSearch,callback:function(e){s.$set(s.options.localBusiness.locations.general,"enhancedSearch",e)},expression:"options.localBusiness.locations.general.enhancedSearch"}}),s.$aioseo.localBusiness.enhancedSearchTest?s._e():t("div",{staticClass:"aioseo-description",domProps:{innerHTML:s._s(s.strings.enhancedSearchError)}}),t("div",{staticClass:"aioseo-description"},[s._v(s._s(s.strings.enhancedSearchDesc))])]},proxy:!0}],null,!1,4125583926)}),s.options.localBusiness.locations.general.enhancedSearch?t("core-settings-row",{staticClass:"location-enhanced-search",attrs:{name:s.strings.enhancedSearchExcerpt},scopedSlots:s._u([{key:"content",fn:function(){return[t("base-radio-toggle",{attrs:{name:"enhancedSearchExcerpt",options:[{label:s.$constants.GLOBAL_STRINGS.off,value:!1,activeClass:"dark"},{label:s.$constants.GLOBAL_STRINGS.on,value:!0}]},model:{value:s.options.localBusiness.locations.general.enhancedSearchExcerpt,callback:function(e){s.$set(s.options.localBusiness.locations.general,"enhancedSearchExcerpt",e)},expression:"options.localBusiness.locations.general.enhancedSearchExcerpt"}}),t("div",{staticClass:"aioseo-description"},[s._v(s._s(s.strings.enhancedSearchExcerptDesc))])]},proxy:!0}],null,!1,1695670279)}):s._e(),t("core-settings-row",{staticClass:"location-admin-labels",attrs:{name:s.strings.customAdminLabels},scopedSlots:s._u([{key:"content",fn:function(){return[t("p",{staticClass:"admin-labels-description"},[s._v(s._s(s.strings.customAdminLabelsDesc))]),t("div",{staticClass:"aioseo-columns"},[t("div",{staticClass:"aioseo-col col-xs-12 col-md-6 text-xs-left"},[t("span",{staticClass:"label-description"},[s._v(s._s(s.strings.singleLabel))]),t("base-input",{attrs:{type:"text",size:"medium"},model:{value:s.options.localBusiness.locations.general.singleLabel,callback:function(e){s.$set(s.options.localBusiness.locations.general,"singleLabel",e)},expression:"options.localBusiness.locations.general.singleLabel"}})],1),t("div",{staticClass:"aioseo-col col-xs-12 col-md-6 text-xs-left"},[t("span",{staticClass:"label-description"},[s._v(s._s(s.strings.pluralLabel))]),t("base-input",{attrs:{type:"text",size:"medium"},model:{value:s.options.localBusiness.locations.general.pluralLabel,callback:function(e){s.$set(s.options.localBusiness.locations.general,"pluralLabel",e)},expression:"options.localBusiness.locations.general.pluralLabel"}})],1)])]},proxy:!0}],null,!1,4277414536)})],1):s._e()],1)},a=[],l=t("5530"),n=(t("ac1f"),t("5319"),t("4de4"),t("b0c0"),t("2f62")),i={data:function(){return{strings:{advancedLocationsSettings:this.$t.__("Advanced Locations Settings",this.$td),locationsPermalink:this.$t.__("Locations Permalink",this.$td),useCustomSlug:this.$t.__("Use custom slug",this.$td),invalidCustomSlug:this.$t.__("Slug is empty or is already taken. Please enter a different one.",this.$td),locationsCategoryPermalink:this.$t.__("Locations Category Permalink",this.$td),useCustomCategorySlug:this.$t.__("Use custom category slug",this.$td),enhancedSearch:this.$t.__("Enhanced Search",this.$td),enhancedSearchDesc:this.$t.__("Include business locations in site-wide search results. Users searching for street name, zip code or city will now also get your business location(s) in their search results.",this.$td),enhancedSearchError:this.$t.sprintf(this.$t.__("Enhanced Search cannot be enabled on your website because there is a search query conflict. To learn more about this, %1$sclick here%2$s.",this.$td),'<a href="'.concat(this.$links.getDocUrl("localSeoSearchQueryConflict"),'" target="_blank">'),"</a>"),enhancedSearchExcerpt:this.$t.__("Enhanced Search - Excerpt",this.$td),enhancedSearchExcerptDesc:this.$t.__("Shows the location address appended to the search result.",this.$td),customAdminLabels:this.$t.__("Custom Admin Labels",this.$td),customAdminLabelsDesc:this.$t.__("With multiple locations, you will have a new menu item in your admin sidebar. By default, this menu item is labeled using the plural term of locations with each single item being called a location. If you like, you may enter custom labels to better match your business.",this.$td),singleLabel:this.$t.__("Single label",this.$td),pluralLabel:this.$t.__("Plural label",this.$td)},validCustomSlug:!0,validCustomCategorySlug:!0}},computed:Object(l["a"])(Object(l["a"])({},Object(n["e"])(["options"])),{},{currentPostTypeSlug:function(){return this.options.localBusiness.locations.general.useCustomSlug&&this.options.localBusiness.locations.general.customSlug?this.options.localBusiness.locations.general.customSlug:this.$aioseo.localBusiness.postTypeDefaultSlug},currentTaxonomySlug:function(){return this.options.localBusiness.locations.general.useCustomCategorySlug&&this.options.localBusiness.locations.general.customCategorySlug?this.options.localBusiness.locations.general.customCategorySlug:this.$aioseo.localBusiness.taxonomyDefaultSlug}}),methods:{validateCustomSlug:function(s){var e=this;this.validCustomSlug=!0,s=s.replace(/^\/+/,"").replace(/\/+$/,"").replace(/\s+/g,"-"),this.options.localBusiness.locations.general.customSlug=s,(0>=s.length||0<this.$aioseo.postData.postTypes.filter((function(t){return t.name!==e.$aioseo.localBusiness.postTypeName&&t.slug===s})).length)&&(this.validCustomSlug=!1)},validateCustomCategorySlug:function(s){var e=this;this.validCustomCategorySlug=!0,s=s.replace(/^\/+/g,"").replace(/\/+$/g,"").replace(/\s+/g,"-"),this.options.localBusiness.locations.general.customCategorySlug=s,(0>=s.length||0<this.$aioseo.postData.taxonomies.filter((function(t){return t.name!==e.$aioseo.localBusiness.taxonomyName&&t.slug===s})).length)&&(this.validCustomCategorySlug=!1)}}},c=i,r=t("2877"),u=Object(r["a"])(c,o,a,!1,null,null,null);e["default"]=u.exports}}]);