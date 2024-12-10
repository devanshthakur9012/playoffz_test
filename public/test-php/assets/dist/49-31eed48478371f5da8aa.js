/*!
 * Stock Portfolio Tracker
 * ------------------------------
 * Version 2.1.0, built on Friday, August 11, 2023
 * Copyright (c) Financial Apps and Plugins <info@financialplugins.com>. All rights reserved.
 * Demo: https://financialplugins.com/products/stock-portfolio-tracker/
 * Purchase (WordPress plugin): https://1.envato.market/ZQN1Zk
 * Purchase (PHP plugin): https://1.envato.market/zN4376
 * 
 */
(window.webpackJsonpspt210=window.webpackJsonpspt210||[]).push([[49],{27:function(t,s,n){"use strict";var e=function(){var t=this,s=t.$createElement;return(t._self._c||s)("button",{class:t.classes,on:{click:function(s){return t.$parent.action(t.action)}}},[t._t("default")],2)};e._withStripped=!0;var i={props:["action","submitted"],computed:{classes:function(){return["spt-button","spt-is-primary",{"spt-is-loading":this.submitted}]}}},a=n(20),o=Object(a.a)(i,e,[],!1,null,null,null);o.options.__file="assets/js/src/components/elements/submit-button.vue";s.a=o.exports},311:function(t,s,n){"use strict";n.r(s);var e=function(){var t=this,s=t.$createElement,n=t._self._c||s;return n("div",[n("div",{staticClass:"spt-columns spt-is-centered spt-mh-100vh spt-is-vcentered"},[n("div",{staticClass:"spt-column spt-is-half spt-has-text-centered"},[n("h2",{staticClass:"spt-title spt-is-2"},[t._v(t._s(t.__("Something is wrong")))]),t._v(" "),n("h3",{staticClass:"spt-subtitle spt-is-3"},[t._v(t._s(t.__("Nothing is found")))]),t._v(" "),n("router-link",{staticClass:"spt-button spt-is-primary",attrs:{to:{name:"home"}}},[t._v(t._s(t.__("Home page")))])],1)])])};e._withStripped=!0;var i=n(44),a=(n(51),n(29)),o=n(33),r=n(27),u={mixins:[a.a,o.a],components:{SubmitButton:r.a},data:function(){return{email:null,password:null}},methods:{login:function(){var t=this;return i.a.auth().signInWithEmailAndPassword(this.email,this.password).then((function(s){t.$router.replace({name:"home"})}))}}},l=n(20),c=Object(l.a)(u,e,[],!1,null,null,null);c.options.__file="assets/js/src/components/errors/404.vue";s.default=c.exports}}]);