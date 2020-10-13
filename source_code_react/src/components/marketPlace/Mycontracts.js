import React, { Component } from "react";
import axios from "axios";
import Header from "../shared/Header";
import Sidebar from "../shared/Sidebar";
import Alert from "react-bootstrap/Alert";
import { Helper, url } from "../../helper/helper";
import { Link } from "react-router-dom";
import { withTranslation } from "react-i18next";

class Mycontracts extends Component {
  feeds_search = [];
  state = {
    feeds: [],
    status: "",
    search: "",
    proposal_submitted: false,

    left: null,
    right: null,
  };

  componentDidMount = () => {
    this.loadNotif();
    this.loadConfig();
  };

  loadConfig = async () => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/config/currency`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        const { left, right } = result.data;
        this.setState({ left, right });
      })
      .catch((err) => {
        console.log(err);
      });
  };

  loadNotif = async () => {
    const token = await localStorage.getItem("token");
    const response = await axios.get(`${url}/api/contracts`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    if (response.status === 200) {
      this.setState({ feeds: response.data.data });
      this.feeds_search = this.state.feeds;
    }
  };

  handleStatus = async (id, status) => {
    const token = await localStorage.getItem("token");
    const response = await axios.post(
      `${url}/api/contracts/status/${id}/${status}`,
      null,
      {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
    );
    console.log(response);
    if (response.status === 200 && status === 3) {
      this.setState({ proposal_submitted: true });
    }
  };

  handleChange = (event) => {
    this.setState(
      { feeds: this.feeds_search, status: event.target.value },
      () => {
        if (this.state.status == "--Select--") {
          window.location.reload();
        }
        this.setState((prevstate) => ({
          feeds: prevstate.feeds.filter((data) => {
            return data.tender_status == this.state.status;
          }),
        }));
      }
    );
  };

  handleSearch = (event) => {
    this.setState(
      { feeds: this.feeds_search, search: event.target.value },
      () => {
        if (this.state.search == "--Select--") {
          window.location.reload();
        }
        this.setState((prevstate) => ({
          feeds: prevstate.feeds.filter((data) => {
            if (this.state.search == "Work" || this.state.search == "Material")
              return data.tender_category_type.includes(this.state.search);

            return data.tender_type.includes(this.state.search);
          }),
        }));
      }
    );
  };

  render() {
    const { t, i18n } = this.props;

    let alert;
    if (this.state.proposal_submitted === true) {
      alert = (
        <Alert variant="success" style={{ fontSize: "13px" }}>
          Proposal Requested
        </Alert>
      );
    }

    const feed = this.state.feeds.map((feed) => (
      <div class="card mb-1">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-4">
              <p>
                {feed.tender_title}
                <br />
                <b class="fw-500">{feed.sender}</b>
                <br />
                <span class="date">Started: {feed.created_at} </span>
              </p>
              <p>
                {feed.tender_status === 4 ? (
                  <span class="badge badge-tag badge-danger">Pending</span>
                ) : feed.tender_status === 3 ? (
                  <span class="badge badge-tag badge-danger">Complete</span>
                ) : feed.tender_status === 5 ? (
                  <span class="badge badge-tag badge-danger">Cancel</span>
                ) : feed.tender_status === 6 ? (
                  <div>
                    <span class="badge badge-tag badge-info">Ongoing</span>
                    <span class="badge badge-tag badge-secondary">Sent</span>
                  </div>
                ) : (
                  <span class="badge badge-tag badge-info">Ongoing</span>
                )}
                {/* <span class="badge badge-tag badge-secondary">My Contract</span>
                                <span class="badge badge-tag badge-primary">My Job</span>
                                <span class="badge badge-tag badge-info">Ongoing</span>
                                <span class="badge badge-tag badge-success">Complete</span>
                                <span class="badge badge-tag badge-warning">Pending</span>
                                <span class="badge badge-tag badge-danger">Cancel</span> */}
              </p>
            </div>
            <div class="col-lg-4">
              <b class="fw-500">
                {this.state.left}
                {feed.tender_quantity
                  ? feed.tender_quantity
                  : feed.tender_rate
                  ? feed.tender_rate
                  : feed.tender_cost_per_unit}
                {this.state.right}/{" "}
                {feed.tender_budget ? feed.tender_budget : feed.tender_unit}
              </b>
              <br />
              <span class="date">
                {feed.tender_available_from} - {feed.tender_available_to}
              </span>
            </div>
            <div class="col-lg-4">
              {feed.bid_status !== 3 || feed.bid_status === 1 ? (
                feed.sender_isLogged &&
                feed.bid_status !== 2 &&
                feed.sender_isLogged &&
                feed.tender_status !== 5 &&
                feed.sender_isLogged &&
                feed.tender_status !== 6 ? (
                  <button
                    href="#"
                    onClick={() =>
                      this.handleStatus(feed.notification_bid_id, 3)
                    }
                    class="btn btn-outline-dark mt-3 mr-5"
                  >
                    {t("my_contracts.request_proposal")}
                  </button>
                ) : null
              ) : null}

              {feed.bid_status === 3 &&
              feed.tender_status !== 6 &&
              !feed.sender_isLogged ? (
                <Link
                  class="btn btn-outline-dark mt-3 mr-5"
                  to={{
                    pathname: `/business-propsal-create/${feed.notification_bid_id}/${feed.notification_sender_id}`,
                  }}
                >
                  {t("my_contracts.submit_proposal")}
                </Link>
              ) : null}
              <button
                href="#"
                onClick={() => this.handleStatus(feed.notification_bid_id, 4)}
                class="btn btn-gray mt-3"
              >
                {t("my_contracts.cancel")}
              </button>
            </div>
          </div>
        </div>
      </div>
    ));

    return (
      <div>
        <Header active={"market"} />
        <div className="sidebar-toggle"></div>
        <nav aria-label="breadcrumb">
          <ol className="breadcrumb">
            <li className="breadcrumb-item active" aria-current="page">
              {t("header.marketplace")}
            </li>
            <li className="breadcrumb-item active" aria-current="page">
              {t("my_contracts.title")}
            </li>
          </ol>
        </nav>
        <div className="main-content">
          <Sidebar dataFromParent={this.props.location.pathname} />
          <div className="page-content">
            <div className="container-fluid">
              {alert ? alert : null}
              <h3 className="head3">{t("my_contracts.title")}</h3>
              <div className="card">
                <div className="card-body">
                  <div class="filter">
                    <div class="row align-items-center">
                      <div class="col-xl col-md-6 col-sm-6">
                        <div class="form-group">
                          <label for="type1">
                            {t("my_contracts.search.type1")}{" "}
                          </label>
                          <select
                            onChange={this.handleSearch}
                            id="type1"
                            class="form-control"
                          >
                            <option>Work</option>
                            <option>Material</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-xl col-md-6 col-sm-6">
                        <div class="form-group">
                          <label for="type2">
                            {t("my_contracts.search.type2")}{" "}
                          </label>
                          <select
                            onChange={this.handleSearch}
                            id="type2"
                            class="form-control"
                          >
                            <option>Offer</option>
                            <option>Request</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-xl-3 col-md-6 col-sm-6">
                        <div class="form-group">
                          <label for="Sort">
                            {t("my_contracts.search.sort_by")}
                          </label>
                          <select
                            onChange={this.handleChange}
                            id="Sort"
                            class="form-control"
                          >
                            <option value="1">Ongoing</option>
                            <option value="3">Completed</option>
                            <option value="4">Pending</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-xl col-md-6 col-sm-6">
                        <label class="d-none d-sm-block">&nbsp;</label>
                        <div class="form-group">
                          <div class="form-check form-check-inline">
                            <input
                              type="checkbox"
                              class="form-check-input"
                              id="exampleCheck1"
                            />
                            <label class="form-check-label" for="exampleCheck1">
                              {t("my_contracts.search.closed_contract")}
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              {feed}
            </div>
          </div>
        </div>
      </div>
    );
  }
}

export default withTranslation()(Mycontracts);
