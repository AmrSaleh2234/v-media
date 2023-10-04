@extends('admin.layouts.login')
@section('title')
    {{ __('Login') }}
@stop
@section('after_head')
    <style>
        .otp-inputs input:first-child {
            margin-right: 18px;
        }
    </style>
@stop
@section('content')
    {{--  @include('admin.errors.errors')  --}}
    <div class="login-card">
        <div class="logo-container">
            <x-logo></x-logo>
        </div>
        <h2>{{ __('names.employee-gate') }}</h2>

        <form class="login-form form-group" role="form" method="POST" action="{{ route('admin.login') }}">
            {{ csrf_field() }}

            <input type="hidden" name="email" value="{{ request()->input('email') ?? null }}">
            <h4>{{ __('names.login') }}</h4>
            <div class="label-container">
                <p>برجاء ارسال كود التحقق المرسل اليك علي</p>
                <p class="fw-bold">{{ request()->input('email') ?? null }}</p>
            </div>
            <input name="otp" id="otp-input" type="text" class="form-control hidden-input"
                   placeholder="ادخل كود التحقق"/>

            <div class="otp-input-container @if (count($errors) > 0 || Session::get('error')) is-invalid @endif"
                 id="otp">
                <div class="digit"></div>
                <div class="digit"></div>
                <div class="digit"></div>
                <div class="digit"></div>
                <div class="digit"></div>
            </div>

            {{-- <div class="otp-form @if (count($errors) > 0 || Session::get('error')) error-code @endif">
                <div class="otp-input-container" style="direction: ltr">
                    <input class="digit" type="text" name="otp[]" maxlength="1" pattern="[0-9]" required />
                    <input class="digit" type="text" name="otp[]" maxlength="1" pattern="[0-9]" required />
                    <input class="digit" type="text" name="otp[]" maxlength="1" pattern="[0-9]" required />
                    <input class="digit" type="text" name="otp[]" maxlength="1" pattern="[0-9]" required />
                    <input class="digit" type="text" name="otp[]" maxlength="1" pattern="[0-9]" required />
                </div>
            </div> --}}
            @if (count($errors) > 0 || Session::get('error'))
                <div class="text-center">
                    <span class="text-danger">رمز التحقق غير صحيح، حاول مره اخرى</span>
                </div>
            @endif
            <div class="d-flex align-items-center flex-column">
                <button type="submit" class="btn btn-primary">التأكيد</button>
            </div>

            <div class="text-center">
                <p class="massage-code blue">
                    {{ __('message.otp-not-send') }}
                    <a
                        href="{{ route('admin.check.again', ['email' => request()->input('email') ?? null]) }}">
                        {{ __('names.resend') }}
                    </a>
                </p>
            </div>
        </form>
    </div>
@stop
@section('script')
    <script>
        var adminLoginOtpModule =
            /******/
            (function (modules) { // webpackBootstrap
                /******/ // The module cache
                /******/
                var installedModules = {};
                /******/
                /******/ // The require function
                /******/
                function __webpack_require__(moduleId) {
                    /******/
                    /******/ // Check if module is in cache
                    /******/
                    if (installedModules[moduleId]) {
                        /******/
                        return installedModules[moduleId].exports;
                        /******/
                    }
                    /******/ // Create a new module (and put it into the cache)
                    /******/
                    var module = installedModules[moduleId] = {
                        /******/
                        i: moduleId,
                        /******/
                        l: false,
                        /******/
                        exports: {}
                        /******/
                    };
                    /******/
                    /******/ // Execute the module function
                    /******/
                    modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
                    /******/
                    /******/ // Flag the module as loaded
                    /******/
                    module.l = true;
                    /******/
                    /******/ // Return the exports of the module
                    /******/
                    return module.exports;
                    /******/
                }

                /******/
                /******/
                /******/ // expose the modules object (__webpack_modules__)
                /******/
                __webpack_require__.m = modules;
                /******/
                /******/ // expose the module cache
                /******/
                __webpack_require__.c = installedModules;
                /******/
                /******/ // define getter function for harmony exports
                /******/
                __webpack_require__.d = function (exports, name, getter) {
                    /******/
                    if (!__webpack_require__.o(exports, name)) {
                        /******/
                        Object.defineProperty(exports, name, {
                            enumerable: true,
                            get: getter
                        });
                        /******/
                    }
                    /******/
                };
                /******/
                /******/ // define __esModule on exports
                /******/
                __webpack_require__.r = function (exports) {
                    /******/
                    if (typeof Symbol !== 'undefined' && Symbol.toStringTag) {
                        /******/
                        Object.defineProperty(exports, Symbol.toStringTag, {
                            value: 'Module'
                        });
                        /******/
                    }
                    /******/
                    Object.defineProperty(exports, '__esModule', {
                        value: true
                    });
                    /******/
                };
                /******/
                /******/ // create a fake namespace object
                /******/ // mode & 1: value is a module id, require it
                /******/ // mode & 2: merge all properties of value into the ns
                /******/ // mode & 4: return value when already ns object
                /******/ // mode & 8|1: behave like require
                /******/
                __webpack_require__.t = function (value, mode) {
                    /******/
                    if (mode & 1) value = __webpack_require__(value);
                    /******/
                    if (mode & 8) return value;
                    /******/
                    if ((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
                    /******/
                    var ns = Object.create(null);
                    /******/
                    __webpack_require__.r(ns);
                    /******/
                    Object.defineProperty(ns, 'default', {
                        enumerable: true,
                        value: value
                    });
                    /******/
                    if (mode & 2 && typeof value != 'string')
                        for (var key in value) __webpack_require__.d(ns, key, function (key) {
                            return value[key];
                        }.bind(null, key));
                    /******/
                    return ns;
                    /******/
                };
                /******/
                /******/ // getDefaultExport function for compatibility with non-harmony modules
                /******/
                __webpack_require__.n = function (module) {
                    /******/
                    var getter = module && module.__esModule ?
                        /******/
                        function getDefault() {
                            return module['default'];
                        } :
                        /******/
                        function getModuleExports() {
                            return module;
                        };
                    /******/
                    __webpack_require__.d(getter, 'a', getter);
                    /******/
                    return getter;
                    /******/
                };
                /******/
                /******/ // Object.prototype.hasOwnProperty.call
                /******/
                __webpack_require__.o = function (object, property) {
                    return Object.prototype.hasOwnProperty.call(object, property);
                };
                /******/
                /******/ // __webpack_public_path__
                /******/
                __webpack_require__.p = "";
                /******/
                /******/
                /******/ // Load entry module and return exports
                /******/
                return __webpack_require__(__webpack_require__.s = "./ts/adminLogin-otp.ts");
                /******/
            })
                /************************************************************************/
                /******/
                ({

                    /***/
                    "./ts/adminLogin-otp.ts":
                    /*!******************************!*\
                    !*** ./ts/adminLogin-otp.ts ***!
                    \******************************/
                    /*! no static exports found */
                    /***/
                        (function (module, exports) {

                            var otpContainer = document.getElementById("otp");
                            var otpInput = document.getElementById("otp-input");
                            var events = ["input", "focus"];
                            otpContainer === null || otpContainer === void 0 ? void 0 : otpContainer.addEventListener(
                                "click",
                                function () {
                                    otpInput === null || otpInput === void 0 ? void 0 : otpInput.focus();
                                });
                            events.forEach(function (event) {
                                otpInput === null || otpInput === void 0 ? void 0 : otpInput.addEventListener(event,
                                    function () {
                                        inputHandler(otpInput);
                                        setTimeout(function () {

                                        }, 500);
                                    });
                            });
                            otpInput === null || otpInput === void 0 ? void 0 : otpInput.addEventListener("paste",
                                function () {
                                    //   updateBlocks();
                                });

                            function inputHandler(input) {
                                setTimeout(function () {
                                    if (input.value.length > 5) {
                                        input.value = input.value.substring(0, 5);
                                    }
                                    if (!/^\d+$/.test(input.value)) {
                                        //   input.value = input.value.substring(0, input.value.length - 1);
                                        for (var x = 0; x < input.value.length; x++) {
                                        }
                                        input.value = "";
                                    }
                                    setTimeout(function () {
                                        updateBlocks();
                                    }, 0);
                                }, 0);
                            }

                            function updateBlocks() {
                                var digits = otpContainer.getElementsByClassName("digit");
                                var value = otpInput.value;
                                for (var i = 0; i < digits.length; i++) {
                                    var digit = digits[i];
                                    digit.classList.contains("focus") && digit.classList.remove("focus");
                                    digit.innerText = "";
                                }
                                for (var _i = 0; _i < value.length; _i++) {
                                    var _digit = digits[_i];
                                    _digit.innerText = value[_i];
                                }
                                if (value.length < 5) digits[value.length].classList.add("focus");
                            }

                            /***/
                        })

                    /******/
                });
        //# sourceMappingURL=adminLoginOtp.js.map
    </script>
@stop
