import React, { Component } from "react";
import axios from "axios";
import { Helper, url, reload } from "../../helper/helper";
import Logo from "../../images/logo.png";
import Avatar from "../../images/avatar.jpg";
import { Link, Redirect } from "react-router-dom";
import { withTranslation } from "react-i18next";
import i18n from "../../locales/i18n";

class Header extends Component {
  state = {
    loggedIn: true,
    count: 0,
    info: [],
    notif: [],
  };

  componentDidMount = () => {
    this._isMounted = true;
    this.axiosCancelSource = axios.CancelToken.source();

    this.loadToken();
    this.loadNotif(this.axiosCancelSource);
    this.loadData(this.axiosCancelSource);
  };

  componentWillUnmount() {
    this._isMounted = false;
    this.axiosCancelSource.cancel();
  }

  loadData = async (axiosCancelSource) => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/account`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
        cancelToken: axiosCancelSource.token,
      })
      .then(({ data }) => {
        if (this._isMounted) {
          this.setState({ info: data });
        }
      })
      .catch((err) => {
        if (axios.isCancel(err)) {
          console.log("Request canceled", err.message);
        } else {
          console.log(err.response);
        }
      });
  };

  loadNotif = async (axiosCancelSource) => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/getBidsNotif`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
        cancelToken: axiosCancelSource.token,
      })
      .then((response) => {
        if (this._isMounted) {
          this.setState({
            notif: response.data.data,
            count: response.data.count,
          });
        }
      })
      .catch((err) => {
        if (axios.isCancel(err)) {
          console.log("Request canceled", err.message);
        } else {
          console.log(err.response);
        }
      });
  };

  readNotif = async (id) => {
    const token = await localStorage.getItem("token");
    const response = await axios.put(
      `${url}/api/notification/read/${id}`,
      null,
      {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
    );
  };

  loadToken = async () => {
    const token = await localStorage.getItem("token");
    if (token == null) {
      this.setState({ loggedIn: false });
    }
  };

  changeLanguage = (lng) => {
    i18n.changeLanguage(lng);
    localStorage.setItem("_lng", lng);
    // window.location.reload();
  };

  render() {
    if (this.state.loggedIn === false) {
      return <Redirect to="/" />;
    }
    const { t, i18n } = this.props;

    return (
      <div>
        <header className="header">
          <div className="logo">
            <img src={Logo} />
          </div>
          <nav className="navbar navbar-expand-md">
            <button
              className="navbar-toggler"
              type="button"
              data-toggle="collapse"
              data-target="#navbarContent"
              aria-controls="navbarContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span className="icon-down"></span>
            </button>
            <div className="collapse navbar-collapse" id="navbarContent">
              <ul className="navbar-nav mr-auto">
                <li
                  className={
                    this.props.active === "bussiness"
                      ? "nav-item active"
                      : "nav-item"
                  }
                >
                  <Link className="nav-link" to="/business-dashboard">
                    {t("header.my_bussiness")}
                    <span className="badge badge-danger">2</span>
                  </Link>
                </li>
                <li
                  className={
                    this.props.active === "market"
                      ? "nav-item active"
                      : "nav-item"
                  }
                >
                  <Link className="nav-link" to="/index">
                    {t("header.marketplace")}
                  </Link>
                </li>
                <li style={{ marginLeft: "65%" }}>
                  <button
                    style={{ float: "left", fontSize: "13px", padding: "5px" }}
                    className={
                      localStorage.getItem("_lng") === "fi"
                        ? "btn font-weight-bold"
                        : "btn"
                    }
                    onClick={() => this.changeLanguage("fi")}
                  >
                    FI
                  </button>
                  <div
                    style={{
                      borderLeft: "1px solid grey",
                      height: "15px",
                      float: "left",
                      marginTop: "6px",
                      marginLeft: "-1px",
                    }}
                  ></div>
                  <button
                    style={{ fontSize: "13px", padding: "5px" }}
                    className={
                      localStorage.getItem("_lng") === "en"
                        ? "btn font-weight-bold"
                        : "btn"
                    }
                    onClick={() => this.changeLanguage("en")}
                  >
                    EN
                  </button>
                </li>
              </ul>
            </div>
          </nav>
          <div className="right-buttons">
            <div className="dropdown">
              <a
                className="dropdown-toggle no-arrow"
                type="button"
                id="alert-messages"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i className="icon-bell"></i>
                {this.state.count > 0 ? (
                  <span className="badge badge-danger"></span>
                ) : null}
              </a>
              <div
                className="dropdown-menu dropdown-menu-right"
                aria-labelledby="alert-messages"
              >
                {this.state.notif.map((notification, index) => (
                  <div>
                    {notification.sender_isLogged &&
                    notification.notification_type === "accept-bid" ? (
                      <Link className="dropdown-item" to="/my-contracts">
                        Submit proposal to {notification.sender}
                      </Link>
                    ) : notification.sender_isLogged &&
                      notification.notification_type === "decline-bid" ? (
                      <Link className="dropdown-item" to="/my-contracts">
                        Proposal declined by {notification.sender}
                      </Link>
                    ) : notification.sender_isLogged &&
                      notification.notification_type === "bid_made" ? (
                      <Link
                        className="dropdown-item"
                        to={{
                          pathname: `/listing-detail/${notification.notification_bid_id}`,
                        }}
                      >
                        {notification.notification_message} by{" "}
                        {notification.sender}
                      </Link>
                    ) : null}

                    {notification.sender_isLogged &&
                    notification.notification_type === "proposal_sent" ? (
                      <div>
                        {" "}
                        <Link
                          onClick={() =>
                            this.readNotif(notification.notification_id)
                          }
                          className="dropdown-item"
                          to="/my-contracts"
                        >
                          {notification.notification_type === "accept-bid"
                            ? `Bid accepted by ${notification.sender}`
                            : notification.notification_type === "decline-bid"
                            ? `Bid declined by ${notification.sender}`
                            : null}
                        </Link>
                        <Link
                          to={{
                            pathname: `/proposal-listing`,
                          }}
                          className="dropdown-item"
                        >
                          {notification.sender_isLogged &&
                          notification.notification_type === "proposal_sent"
                            ? `Proposal sent by ${notification.sender} on email`
                            : null}
                        </Link>{" "}
                      </div>
                    ) : null}

                    {notification.sender_isLogged &&
                    notification.notification_type === "agreement_sent" ? (
                      <div>
                        <Link
                          to={{
                            pathname: `/agreement-listing`,
                          }}
                          className="dropdown-item"
                        >
                          {notification.sender_isLogged &&
                          notification.notification_type === "agreement_sent"
                            ? `Agreement sent by ${notification.sender} on email`
                            : null}
                        </Link>{" "}
                      </div>
                    ) : null}

                    {notification.sender_isLogged &&
                    notification.notification_type === "invoice_sent" ? (
                      <div>
                        <Link
                          to={{
                            pathname: `/invoice-list`,
                          }}
                          className="dropdown-item"
                        >
                          {notification.sender_isLogged &&
                          notification.notification_type === "invoice_sent"
                            ? `Invoice sent by ${notification.sender} on email`
                            : null}
                        </Link>{" "}
                      </div>
                    ) : null}

                    {(notification.sender_isLogged &&
                      notification.notification_type ===
                        "agreement_accepted") ||
                    notification.notification_type === "agreement_declined" ||
                    notification.notification_type === "agreement_revision" ? (
                      <div>
                        {notification.sender_isLogged &&
                        notification.notification_type ===
                          "agreement_revision" ? (
                          <Link
                            to={{
                              pathname: `/agreement-listing`,
                            }}
                            className="dropdown-item"
                          >
                            {`Agreement revision by ${notification.sender} for request ${notification.notification_user_id}${notification.notification_bid_id}`}
                          </Link>
                        ) : notification.sender_isLogged &&
                          notification.notification_type !==
                            "agreement_revision" ? (
                          <Link className="dropdown-item">
                            {`Agreement ${notification.notification_message} by ${notification.sender}`}
                          </Link>
                        ) : null}
                      </div>
                    ) : null}

                    {(notification.sender_isLogged &&
                      notification.notification_type === "proposal_accepted") ||
                    notification.notification_type === "proposal_declined" ||
                    notification.notification_type === "proposal_revision" ? (
                      <div>
                        {notification.sender_isLogged &&
                        notification.notification_type ===
                          "proposal_revision" ? (
                          <Link
                            to={{
                              pathname: `/proposal-listing`,
                            }}
                            className="dropdown-item"
                          >
                            {`Proposal revision by ${notification.sender} for request ${notification.notification_user_id}${notification.notification_bid_id}`}
                          </Link>
                        ) : notification.sender_isLogged &&
                          notification.notification_type !==
                            "proposal_revision" ? (
                          <Link className="dropdown-item">
                            {`Proposal ${notification.notification_message} by ${notification.sender}`}
                          </Link>
                        ) : null}
                      </div>
                    ) : null}
                  </div>
                ))}
                <div class="dropdown-divider"></div>
                <Link className="dropdown-item" to="/my-contracts">
                  {t("header.view_all")}
                </Link>
              </div>
            </div>
            <div className="dropdown">
              <a
                className="dropdown-toggle"
                id="dropdownMenuButton"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <div className="avatar">
                  <img
                    className="rounded-circle"
                    src={
                      this.state.info.company_logo === null
                        ? Avatar
                        : url +
                          "/images/marketplace/company_logo/" +
                          this.state.info.company_logo
                    }
                    alt="Logo"
                  />
                </div>
                <span>{this.state.info.first_name}</span>
              </a>
              <div
                className="dropdown-menu dropdown-menu-right"
                aria-labelledby="dropdownMenuButton"
              >
                <Link className="dropdown-item" to="/myaccount">
                  {t("account.my_account")}
                </Link>
                <Link className="dropdown-item" to="/logout">
                  {t("account.logout")}
                </Link>
              </div>
            </div>
          </div>
        </header>
      </div>
    );
  }
}

export default withTranslation()(Header);
