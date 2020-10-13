import React, { Component } from "react";
import axios from "axios";
import Header from "../shared/Header";
import Sidebar from "../shared/Sidebar";
import { Helper, url } from "../../helper/helper";
import moment from "moment";
// the render prop
import { Translation } from "react-i18next";
import { HashRouter as Router, Link } from "react-router-dom";

class Index extends Component {
  constructor(props) {
    super(props);
    this.state = {
      saved: null,
      lng: "",
      statsReq: [],
      statsOffer: [],
      req_acc: [],
      req_dec: [],
      offer_acc: [],
      offer_dec: [],
    };
  }

  componentDidMount = async () => {
    this._isMounted = true;
    this.axiosCancelSource = axios.CancelToken.source();

    this.loadStats(this.axiosCancelSource);
    this.loadSaved(this.axiosCancelSource);
  };

  componentWillUnmount() {
    this._isMounted = false;
    this.axiosCancelSource.cancel();
  }

  loadSaved = async (axiosCancelSource) => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/saved`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
        cancelToken: axiosCancelSource.token,
      })
      .then((result) => {
        if (this._isMounted) {
          this.setState({ saved: result.data.count });
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

  loadStats = async (axiosCancelSource) => {
    const token = await localStorage.getItem("token");
    const requestOne = axios.get(`${url}/api/dashboard/request`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
      cancelToken: axiosCancelSource.token,
    });
    const requestTwo = axios.get(`${url}/api/dashboard/offer`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
      cancelToken: axiosCancelSource.token,
    });
    const requestThree = axios.get(`${url}/api/dashboard/request-acc`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
      cancelToken: axiosCancelSource.token,
    });
    const requestFour = axios.get(`${url}/api/dashboard/request-dec`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
      cancelToken: axiosCancelSource.token,
    });
    const requestFive = axios.get(`${url}/api/dashboard/offer-acc`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
      cancelToken: axiosCancelSource.token,
    });
    const requestSix = axios.get(`${url}/api/dashboard/offer-dec`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
      cancelToken: axiosCancelSource.token,
    });

    axios
      .all([
        requestOne,
        requestTwo,
        requestThree,
        requestFour,
        requestFive,
        requestSix,
      ])
      .then(
        axios.spread((...responses) => {
          if (this._isMounted) {
            const responseOne = responses[0].data;
            const responseTwo = responses[1].data;
            const requestThree = responses[2].data;
            const requestFour = responses[3].data;
            const requestFive = responses[4].data;
            const requestSix = responses[5].data;
            // use/access the results
            this.setState({
              statsReq: responseOne.data,
              statsOffer: responseTwo.data,
              req_acc: requestThree.count,
              req_dec: requestFour.count,
              offer_acc: requestFive.count,
              offer_dec: requestSix.count,
            });
          }
        })
      )
      .catch((errors) => {
        if (axios.isCancel(errors)) {
          console.log("Request canceled", errors.message);
        } else {
          console.log(errors.response);
        }
      });
  };

  render() {
    const myReqCount = this.state.statsReq.map((stat) => {
      return this.state.statsReq.reduce(
        (counter, stat) =>
          moment(stat.tender_expiry_date).isBefore(moment()._d)
            ? counter + 1
            : counter,
        0
      );
    });
    const myOfferCount = this.state.statsOffer.map((stat) => {
      return this.state.statsOffer.reduce(
        (counter, stat) =>
          moment(stat.tender_expiry_date).isBefore(moment()._d)
            ? counter + 1
            : counter,
        0
      );
    });

    return (
      <div>
        <Header active={"market"} />
        <div className="sidebar-toggle"></div>
        <nav aria-label="breadcrumb">
          <ol className="breadcrumb">
            <Translation>
              {(t) => (
                <li className="breadcrumb-item active" aria-current="page">
                  {t("index.title")}
                </li>
              )}
            </Translation>
          </ol>
        </nav>
        <div className="main-content">
          <Sidebar dataFromParent={this.props.location.pathname} />
          <div className="page-content">
            <div className="container">
              <Translation>
                {(t) => <h3 className="head3">{t("index.title2")}</h3>}
              </Translation>
              <div className="row">
                <div className="col-xl-3 col-lg-4 col-sm-6">
                  <div className="card db-card">
                    <div className="card-header">
                      <Translation>
                        {(t) => (
                          <h4>
                            <i className="icon-materials"></i>
                            {t("index.materials")}
                          </h4>
                        )}
                      </Translation>
                    </div>
                    <div className="card-body">
                      <ul>
                        <Translation>
                          {(t) => (
                            <li>
                              <Link to="/create-material-list">
                                {t("index.my_bids.make_offer")}
                              </Link>
                            </li>
                          )}
                        </Translation>
                        <Translation>
                          {(t) => (
                            <li>
                              <Link to="/create-material-list">
                                {t("index.my_bids.make_request")}
                              </Link>
                            </li>
                          )}
                        </Translation>
                        <Translation>
                          {(t) => (
                            <li>
                              <Link to="/material-list">
                                {t("index.my_bids.see_listings")}
                              </Link>
                            </li>
                          )}
                        </Translation>
                      </ul>
                    </div>
                  </div>
                </div>
                <div className="col-xl-3 col-lg-4 col-sm-6">
                  <div className="card db-card">
                    <div className="card-header">
                      <Translation>
                        {(t) => (
                          <h4>
                            <i className="icon-work"></i>
                            {t("index.work")}
                          </h4>
                        )}
                      </Translation>
                    </div>
                    <div className="card-body">
                      <ul>
                        <Translation>
                          {(t) => (
                            <li>
                              <Link to="/create-work-list">
                                {t("index.my_bids.make_offer")}
                              </Link>
                            </li>
                          )}
                        </Translation>
                        <Translation>
                          {(t) => (
                            <li>
                              <Link to="/create-work-list">
                                {t("index.my_bids.make_request")}
                              </Link>
                            </li>
                          )}
                        </Translation>
                        <Translation>
                          {(t) => (
                            <li>
                              <Link to="/work-list">
                                {t("index.my_bids.see_listings")}
                              </Link>
                            </li>
                          )}
                        </Translation>
                      </ul>
                    </div>
                  </div>
                </div>
                <div className="col-xl-3 col-lg-4 col-sm-6">
                  <div className="card db-card">
                    <div className="card-header">
                      <Translation>
                        {(t) => (
                          <h4>
                            <i className="icon-request"></i>
                            {t("index.request")}
                          </h4>
                        )}
                      </Translation>
                    </div>
                    <div className="card-body">
                      <ul>
                        <Translation>
                          {(t) => (
                            <li>
                              {t("index.my_request.accepted")}{" "}
                              <span className="badge badge-light">
                                {this.state.req_acc}
                              </span>
                            </li>
                          )}
                        </Translation>
                        <Translation>
                          {(t) => (
                            <li>
                              {t("index.my_request.declined")}{" "}
                              <span className="badge badge-light">
                                {this.state.req_dec}
                              </span>
                            </li>
                          )}
                        </Translation>
                        <Translation>
                          {(t) => (
                            <li>
                              {t("index.my_request.expired")}{" "}
                              <span className="badge badge-light">
                                {myReqCount[0]}
                              </span>
                            </li>
                          )}
                        </Translation>
                      </ul>
                    </div>
                  </div>
                </div>
                <div className="col-xl-3 col-lg-4 col-sm-6">
                  <div className="card db-card">
                    <div className="card-header">
                      <Translation>
                        {(t) => (
                          <h4>
                            <i className="icon-offce-details"></i>
                            {t("index.offers")}
                          </h4>
                        )}
                      </Translation>
                    </div>
                    <div className="card-body">
                      <ul>
                        <Translation>
                          {(t) => (
                            <li>
                              {t("index.my_request.accepted")}{" "}
                              <span className="badge badge-light">
                                {this.state.offer_acc}
                              </span>
                            </li>
                          )}
                        </Translation>
                        <Translation>
                          {(t) => (
                            <li>
                              {t("index.my_request.declined")}{" "}
                              <span className="badge badge-light">
                                {this.state.offer_dec}
                              </span>
                            </li>
                          )}
                        </Translation>
                        <Translation>
                          {(t) => (
                            <li>
                              {t("index.my_request.expired")}{" "}
                              <span className="badge badge-light">
                                {myOfferCount[0]}
                              </span>
                            </li>
                          )}
                        </Translation>
                      </ul>
                    </div>
                  </div>
                </div>
                <div className="col-xl-3 col-lg-4 col-sm-6">
                  <div className="card db-card">
                    <div className="card-header">
                      <Link className="nav-link" to="/saved">
                        <Translation>
                          {(t) => (
                            <h4>
                              <i className="icon-jobs"></i>
                              {t("index.jobs")}{" "}
                              <span className="badge badge-light">
                                {this.state.saved}
                              </span>
                            </h4>
                          )}
                        </Translation>
                      </Link>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

export default Index;
