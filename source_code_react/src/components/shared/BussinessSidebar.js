import React, { Component } from "react";
import { Link } from "react-router-dom";
import axios from "axios";
import { Helper, url } from "../../helper/helper";
import { withTranslation } from "react-i18next";
import $ from "jquery";

class BussinessSidebar extends Component {
  state = {
    pms_token: null,
  };

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

  loadToken = async () => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/prousers/token/user`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        this.setState({ pms_token: result.data.token });
        window.location.href = `${url}/pms/sso?token=${this.state.pms_token}`;
      })
      .catch((err) => {
        console.log(err.response);
      });
  };

  render() {
    const { t, i18n } = this.props;

    return (
      <div className="sidebar">
        <div className="wraper">
          <div className="scroll"></div>
          <ul className="nav flex-column">
            <li
              className={
                this.props.dataFromParent === "/business-dashboard"
                  ? "nav-item active"
                  : "nav-item"
              }
            >
              <Link className="nav-link" to="/business-dashboard">
                <i className="icon-dashboard"></i>
                {t("sidebar.pro_desk")}
              </Link>
            </li>

            <li
              className={
                this.props.dataFromParent === "/mycustomers"
                  ? "nav-item active"
                  : this.props.dataFromParent === "/customers-list"
                  ? "nav-item active"
                  : "nav-item"
              }
            >
              <a className="nav-link">
                <i className="icon-fillter"></i>
                {t("b_sidebar.cus.customers")}
              </a>
              <ul className="sub-nav">
                <li>
                  <Link to="/mycustomers">
                    {t("b_sidebar.cus.create_customers")}
                  </Link>
                </li>
                <li>
                  <Link to="/customers-list">
                    {t("sidebar.create_listing")}
                  </Link>
                </li>
              </ul>
            </li>

            <li
              className={
                this.props.dataFromParent === "/propsal-projectplanning"
                  ? "nav-item active"
                  : this.props.dataFromParent === "/myproposal" ||
                    this.props.dataFromParent === "/business-propsal-create" ||
                    this.props.dataFromParent === "/proposal-listing"
                  ? "nav-item active"
                  : "nav-item"
              }
            >
              <a className="nav-link">
                <i class="icon-edit-file"></i>
                {t("b_sidebar.proposal.proposal")}
              </a>
              <ul className="sub-nav">
                <li>
                  <Link to="/propsal-projectplanning">
                    {t("b_sidebar.proposal.template")}
                  </Link>
                </li>
                <li>
                  <Link to="/myproposal">
                    {t("b_sidebar.proposal.proposal")}
                  </Link>
                </li>
                <li>
                  <Link to="/proposal-listing">
                    {t("b_sidebar.proposal.listing")}
                  </Link>
                </li>
              </ul>
            </li>

            <li
              className={
                this.props.dataFromParent === "/myagreement"
                  ? "nav-item active"
                  : this.props.dataFromParent === "/myagreement" ||
                    this.props.dataFromParent ===
                      "/business-agreement-create" ||
                    this.props.dataFromParent === "/agreement-listing"
                  ? "nav-item active"
                  : "nav-item"
              }
            >
              <a className="nav-link">
                <i class="icon-materials"></i>
                {t("b_sidebar.agreement.agreement")}
              </a>
              <ul className="sub-nav">
                <li>
                  <Link to="/myagreement">
                    {t("b_sidebar.agreement.agreement")}
                  </Link>
                </li>
                <li>
                  <Link to="/agreement-listing">
                    {t("b_sidebar.proposal.listing")}
                  </Link>
                </li>
              </ul>
            </li>

            <li
              className={
                this.props.dataFromParent === "/saved"
                  ? "nav-item active"
                  : "nav-item"
              }
            >
              <Link onClick={this.loadToken} className="nav-link">
                <i class="icon-work"></i>
                {t("b_sidebar.project.project")}
              </Link>
            </li>

            <li
              className={
                this.props.dataFromParent === "/invoice"
                  ? "nav-item active"
                  : this.props.dataFromParent === "/invoice-list"
                  ? "nav-item active"
                  : "nav-item"
              }
            >
              <a className="nav-link">
                <i className="icon-jobs"></i>
                {t("b_sidebar.invoice.invoice")}
              </a>
              <ul className="sub-nav">
                <li>
                  <Link to="/invoice">
                    {t("b_sidebar.invoice.create_invoice")}
                  </Link>
                </li>
                <li>
                  <Link to="/invoice-list">
                    {t("b_sidebar.invoice.invoice_listing")}
                  </Link>
                </li>
              </ul>
            </li>

            <li
              className={
                this.props.dataFromParent === "/saved"
                  ? "nav-item active"
                  : "nav-item"
              }
            >
              <Link className="nav-link" to="/business-dashboard">
                <i class="icon-chat"></i>
                {t("b_sidebar.messaging.messaging")}
              </Link>
            </li>

            <li
              className={
                this.props.dataFromParent === "/myresources"
                  ? "nav-item active"
                  : this.props.dataFromParent === "/resource-list"
                  ? "nav-item active"
                  : "nav-item"
              }
            >
              <a className="nav-link">
                <i className="icon-work"></i>
                {t("b_sidebar.resources.resources")}
              </a>
              <ul className="sub-nav">
                <li>
                  <Link to="/myresources">
                    {t("b_sidebar.resources.create_resources")}
                  </Link>
                </li>
                <li>
                  <Link to="/resource-list">
                    {t("b_sidebar.resources.resource_listing")}
                  </Link>
                </li>
              </ul>
            </li>

            <li
              className={
                this.props.dataFromParent === "/myphases"
                  ? "nav-item active"
                  : this.props.dataFromParent === "/phase-list"
                  ? "nav-item active"
                  : "nav-item"
              }
            >
              <a className="nav-link">
                <i className="icon-edit-file"></i>
                {t("b_sidebar.phase.phases")}
              </a>
              <ul className="sub-nav">
                <li>
                  <Link to="/myphases">{t("b_sidebar.phase.create")}</Link>
                </li>
                <li>
                  <Link to="/phase-list">{t("b_sidebar.phase.listing")}</Link>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    );
  }
}

export default withTranslation()(BussinessSidebar);
