"use strict";

var _Pagination = require("../Pagination.js");

var p = new _Pagination.Pagination('/filter/product');
p.listenEvent('load', function (e) {
  p.renderCard().then(function (res) {
    p.onPage = 8;
    p.renderFirstData(res);
    p.currentElement = p.paginationRoot.children[1];
    p.prevPage = p.paginationRoot.firstElementChild;
    p.nextPage = p.paginationRoot.lastElementChild;
  });
}, null);
p.listenEvent('click', function (e) {
  e.preventDefault();
  var target = e.target;
  var value = target.dataset.value;
  var filterShow = document.querySelector('.filter-show');

  if (value !== undefined) {
    if (value == 'cheap') {
      filterShow.innerText = target.innerText;
      p.renderCard().then(function (res) {
        p.currentPage = 1;
        console.log(p.prevPage);
        p.currentElement = p.paginationRoot.children[1]; //page 1      

        p.currentData = p.sortArrayByCheap(res);
        p.renderData(p.currentData);
        p.changeColor(p.currentElement, 'active');
        p.changePrevDisabled(p.prevPage, p.currentPage);
        p.changeNextDisabled(p.nextPage, p.currentPage);
      });
    }

    if (value == 'newest') {
      filterShow.innerText = target.innerText;
      p.renderCard().then(function (res) {
        p.currentPage = 1;
        p.currentElement = p.paginationRoot.children[1];
        p.currentData = p.sortArrayNewest(res);
        p.renderData(p.currentData);
        console.log(p.prevPage);
        p.changeColor(p.currentElement, 'active');
        p.changePrevDisabled(p.prevPage, p.currentPage);
        p.changeNextDisabled(p.nextPage, p.currentPage);
      });
    }

    if (value == 'rating') {
      filterShow.innerText = target.innerText;
      p.renderCard().then(function (res) {
        p.currentPage = 1;
        p.currentElement = p.paginationRoot.children[1];
        p.currentData = p.sortArrayByRating(res);
        p.renderData(p.currentData);
        console.log(p.currentDat);
        p.changeColor(p.currentElement, 'active');
        p.changePrevDisabled(p.prevPage, p.currentPage);
        p.changeNextDisabled(p.nextPage, p.currentPage);
      });
    }
  }
}, 'filter-desc');
p.listenEvent('click', function (e) {
  e.preventDefault();
  var target = e.target;
  p.renderCard().then(function (res) {
    if (target.classList.contains('highest')) {
      if (!target.classList.contains('selected')) {
        target.classList.add('selected');
        p.currentData = p.getHighRatings(res);
        p.renderData(p.currentData);
        p.pageCount = p.getPageCount(p.currentData);
        p.currentPage = 1;
        p.changePages(p.paginationRoot);
        p.changeColor(p.currentElement, 'active');
        p.changePrevDisabled(p.prevPage, p.currentPage);
        p.changeNextDisabled(p.nextPage, p.currentPage);
      } else {
        target.classList.remove('selected');
        p.currentData = res;
        p.renderData(p.currentData);
        p.pageCount = p.getPageCount(p.currentData);
        console.log("🚀 ~ file: filter.js ~ line 91 ~ p.renderCard ~ p.pageCount", p.pageCount);
        p.changePages(p.paginationRoot);
        p.changeColor(p.currentElement, 'active');
        p.changePrevDisabled(p.prevPage, p.currentPage);
        p.changeNextDisabled(p.nextPage, p.currentPage);
      } // else if(target.classList.contains('selected')){
      //     p.currentPage = 1;
      //     p.currentData = res;
      // }
      // 
      // 
      // console.log("🚀 ~ file: filter.js ~ line 83 ~ p.renderCard ~ p.paginationRoot", p.paginationRoot)
      // p.renderPagination(p.pageCount)
      // p.renderData(p.currentData);        

    }
  });
}, 'high-rate');
p.listenEvent('click', function (e) {
  e.preventDefault();
  var target = e.target;

  if (Number.isInteger(+target.dataset.page)) {
    p.currentElement = target.parentNode;
    p.currentPage = +target.dataset.page;
    p.changeColor(p.currentElement, 'active');
  }

  if (target.dataset.page == 'previous') {
    p.currentPage--;
    p.currentElement = p.currentElement.previousElementSibling;
    p.changeColor(p.currentElement, 'active');
  }

  ;

  if (target.dataset.page == 'next') {
    p.currentPage++;
    p.currentElement = p.currentElement.nextElementSibling;
    p.changeColor(p.currentElement, 'active');
  }

  ;
  p.renderData(p.currentData);
  p.changePrevDisabled(p.prevPage, p.currentPage);
  p.changeNextDisabled(p.nextPage, p.currentPage);
}, 'pagination-items');