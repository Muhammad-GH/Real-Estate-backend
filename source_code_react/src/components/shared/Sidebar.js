import React, { Component } from "react";
import { Link } from "react-router-dom";
import i18n from "../../locales/i18n";
import { Translation } from "react-i18next";
import $ from "jquery";

class Sidebar extends Component {
  constructor(props) {
    super(props);
    i18n.changeLanguage(localStorage.getItem("_lng"));
  }

  componentDidMount = () => {
    $(".sidebar-toggle").click(function () {
      $(".main-content").toggleClass("show-sidebar");
    });
    $(".main-content").click(function (event) {
      var target = $(event.target);
      if (target.is(".main-content")) {
        $(this).removeClass("show-sidebar");
      }
    });

    $(".sidebar .nav .nav-item .nav-link").click(function () {
      if (!$(this).parent().hasClass("open")) {
        $(".sidebar .nav .nav-item").removeClass("open");
        $(this).parent().addClass("open");
        $(".sidebar .nav .nav-item .sub-nav").slideUp();
        $(this).next().slideDown(".sub-nav");
        return;
      } else {
        $(".sidebar .nav .nav-item").removeClass("open");
        $(this).next().slideUp(".sub-nav");
      }
    });

    $(document).ready(function () {
      var winWidth = $(window).outerWidth();

      var content = $(".main-content");
      if (content.length) {
        var offsettop = Math.floor(content.offset().top);
        var contentOffset = "calc(100vh - " + offsettop + "px)";
        content.css("height", contentOffset);
      }

      function customScroll() {
        var $scrollable = $(".sidebar .nav"),
          $scrollbar = $(".sidebar .scroll"),
          height = $scrollable.outerHeight(true), // visible height
          scrollHeight = $scrollable.prop("scrollHeight"), // total height
          barHeight = (height * height) / scrollHeight; // Scrollbar height!

        var ua = navigator.userAgent;
        if (
          /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|Mobile|mobile|CriOS/i.test(
            ua
          )
        ) {
          $scrollable.css({
            margin: 0,
            width: "100%",
          });
        }

        $scrollbar.height(barHeight);

        var scrollableht = Math.round($scrollable.height());
        var scrollbarht = Math.round($scrollbar.height());

        if (scrollableht <= scrollbarht) {
          $scrollbar.hide();
        } else {
          $scrollbar.show();
        }

        // Element scroll:
        $scrollable.on("scroll", function () {
          $scrollbar.css({
            top: ($scrollable.scrollTop() / height) * barHeight,
          });
        });
      }

      $(window).resize(function () {
        customScroll();
      });
      $(".sidebar .nav").on("scroll mouseout mouseover", function () {
        customScroll();
      });
      customScroll();
    });
  };

  render() {
    return (
      <div className="sidebar">
        <div className="wraper">
          <div className="scroll"></div>
          <ul className="nav flex-column">
            <li
              className={
                this.props.dataFromParent === "/index"
                  ? "nav-item active"
                  : "nav-item"
              }
            >
              <Translation>
                {(t) => (
                  <Link className="nav-link" to="/index">
                    <i className="icon-dashboard"></i>
                    {t("sidebar.pro_desk")}
                  </Link>
                )}
              </Translation>
            </li>
            <li
              className={
                this.props.dataFromParent === "/feeds"
                  ? "nav-item active"
                  : "nav-item"
              }
            >
              <Translation>
                {(t) => (
                  <Link className="nav-link" to="/feeds">
                    <i className="icon-jobs"></i>
                    {t("sidebar.feeds")}
                  </Link>
                )}
              </Translation>
            </li>
            <li
              className={
                this.props.dataFromParent === "/create-material-list"
                  ? "nav-item active"
                  : this.props.dataFromParent === "/material-list"
                  ? "nav-item active"
                  : "nav-item"
              }
            >
              <Translation>
                {(t) => (
                  <a className="nav-link">
                    <i className="icon-materials"></i>
                    {t("index.materials")}
                  </a>
                )}
              </Translation>

              <ul className="sub-nav">
                <li>
                  <Translation>
                    {(t) => (
                      <Link to="/create-material-list">
                        {t("sidebar.create_listing")}
                      </Link>
                    )}
                  </Translation>
                </li>
                <li>
                  <Translation>
                    {(t) => (
                      <Link to="/material-list">
                        {t("sidebar.see_listing")}
                      </Link>
                    )}
                  </Translation>
                </li>
              </ul>
            </li>
            <li
              className={
                this.props.dataFromParent === "/create-work-list"
                  ? "nav-item active"
                  : this.props.dataFromParent === "/work-list"
                  ? "nav-item active"
                  : "nav-item"
              }
            >
              <Translation>
                {(t) => (
                  <a className="nav-link">
                    <i className="icon-work"></i>
                    {t("index.work")}
                  </a>
                )}
              </Translation>
              <ul className="sub-nav">
                <li>
                  <Translation>
                    {(t) => (
                      <Link to="/create-work-list">
                        {t("sidebar.create_listing")}
                      </Link>
                    )}
                  </Translation>
                </li>
                <li>
                  <Translation>
                    {(t) => (
                      <Link to="/work-list">{t("sidebar.see_listing")}</Link>
                    )}
                  </Translation>
                </li>
              </ul>
            </li>
            <li
              className={
                this.props.dataFromParent === "/my-contracts"
                  ? "nav-item active"
                  : "nav-item"
              }
            >
              <Translation>
                {(t) => (
                  <Link className="nav-link" to="/my-contracts">
                    <i className="icon-jobs"></i>
                    {t("index.contract")}
                  </Link>
                )}
              </Translation>
            </li>
            <li
              className={
                this.props.dataFromParent === "/saved"
                  ? "nav-item active"
                  : "nav-item"
              }
            >
              <Translation>
                {(t) => (
                  <Link className="nav-link" to="/saved">
                    <i className="icon-jobs"></i>
                    {t("index.jobs")}
                  </Link>
                )}
              </Translation>
            </li>
          </ul>
        </div>
      </div>
    );
  }
}

export default Sidebar;
