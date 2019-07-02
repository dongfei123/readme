//index.js
//获取应用实例
const app = getApp();

Page({
  /**
   * 页面初始数据
   */
  data: {
    motto: 'Hello World',
    userInfo: {},
    hasUserInfo: false,
    indicatorDots:true,
    vertical:false,
    autoplay:true,
    interval:3000,
    duration:500,
    canIUse: wx.canIUse('button.open-type.getUserInfo')
  },
  //事件处理函数
  bindViewTap: function() {
    wx.navigateTo({
      url: '../logs/logs'
    })
  },

  onLoad: function() {
    var that = this;
    wx. showLoading({
      title: '加载中.....',
    })
    that.setData({
      "swipers":[
        '/images/swiper.jpeg',                     '/images/swiper.jpeg',
        '/images/swiper.jpeg'
      ],
    });
    
  }
})
