/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./resources/js/utils.js ***!
  \*******************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
$.ajaxSetup({
  headers: {
    'X-CLIENT-TOKEN': $('meta[name="client-token"]').attr('content')
  }
});
function request(method, endpoint, data, callback_success, callback_error) {
  $.ajax({
    url: endpoint,
    method: method,
    data: data,
    success: function success(response) {
      if (callback_success) callback_success(response);else console.log('response', response);
    },
    error: function error(xhr) {
      if (callback_error) callback_error(xhr);else console.log('xhr', xhr);
    }
  });
}
function validarCnpj(cnpj, elemResposta, tipoValidacao) {
  if (typeof cnpj != 'string') return;
  if (cnpj.length == 0) return;
  if (_typeof(tipoValidacao) == undefined) tipoValidacao = 'estrutural';
  cnpj = cnpj.replace(/\D/g, '');
  request('GET', "/api/validar-cnpj/".concat(cnpj, "/").concat(tipoValidacao), null, function (response) {
    var classe = response.valido ? 'success' : 'danger';
    if (response.valido && response.mensagem == null) response.mensagem = 'CNPJ é válido';
    if (elemResposta) elemResposta.innerHTML = "<span class=\"text-".concat(classe, "\">").concat(response.mensagem, "</span>");
  });
}
function validarEmail(email, elemResposta) {
  if (typeof email != 'string') return;
  if (email.length == 0) return;
  request('GET', "/api/validar-email/".concat(email), null, function (response) {
    var classe = response.valido ? 'success' : 'danger';
    if (response.valido && response.mensagem == null) response.mensagem = 'E-mail é válido';
    if (elemResposta) elemResposta.innerHTML = "<span class=\"text-".concat(classe, "\">").concat(response.mensagem, "</span>");
  });
}
window.request = request;
window.validarCnpj = validarCnpj;
window.validarEmail = validarEmail;
/******/ })()
;