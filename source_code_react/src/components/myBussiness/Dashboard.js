import React, { Component } from "react";
import axios from "axios";
import { url } from "../../helper/helper";
import Header from "../shared/Header";
import BussinessSidebar from "../shared/BussinessSidebar";
import { withTranslation } from "react-i18next";

class Dashboard extends Component {
  state = {
    proposal: [],
    agreement: [],
    resource: [],
    invoice: [],
    request: [],
  };

  componentDidMount = () => {
    this.myProposal();
    this.myAgreement();
    this.myResource();
    this.myInvoice();
    this.myRequests();
  };

  myProposal = async () => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/dashboard_bussiness/proposal`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        this.setState({ proposal: result.data.data });
      })
      .catch((err) => {
        console.log(err);
      });
  };
  myAgreement = async () => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/dashboard_bussiness/agreement`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        this.setState({ agreement: result.data.data });
      })
      .catch((err) => {
        console.log(err);
      });
  };
  myResource = async () => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/dashboard_bussiness/resources`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        this.setState({ resource: result.data.data });
      })
      .catch((err) => {
        console.log(err);
      });
  };
  myInvoice = async () => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/dashboard_bussiness/invoice`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        this.setState({ invoice: result.data.data });
      })
      .catch((err) => {
        console.log(err);
      });
  };
  myRequests = async () => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/dashboard_bussiness/requests`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        this.setState({ request: result.data.data });
      })
      .catch((err) => {
        console.log(err);
      });
  };

  render() {
    const { t, i18n } = this.props;

    return (
      <div>
        <Header active={"bussiness"} />
        <div class="sidebar-toggle"></div>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
              {t("mycustomer.heading")}
            </li>
          </ol>
        </nav>
        <div className="main-content">
          <BussinessSidebar dataFromParent={this.props.location.pathname} />
          <div className="page-content">
            <div className="container">
              <h3 className="head3">{t("bussiness_dashboard.heading")}</h3>
              <div className="row">
                <div className="col-xl-3 col-lg-4 col-sm-6">
                  <div className="card db-card">
                    <div className="card-header">
                      <h4>
                        <i className="icon-edit-file"></i>
                        {t("bussiness_dashboard.proposals")}{" "}
                        <span className="badge badge-light">
                          {this.state.proposal.total}
                        </span>
                      </h4>
                    </div>
                    <div className="card-body">
                      <ul>
                        <li>
                          {t("bussiness_dashboard.Open")}{" "}
                          <span className="badge badge-light">
                            {" "}
                            {this.state.proposal.open}
                          </span>
                        </li>
                        <li>
                          {t("bussiness_dashboard.Old")}{" "}
                          <span className="badge badge-light">
                            {" "}
                            {this.state.proposal.old}
                          </span>
                        </li>
                        <li>
                          {t("bussiness_dashboard.Expired")}{" "}
                          <span className="badge badge-light">
                            {" "}
                            {this.state.proposal.expired}
                          </span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div className="col-xl-3 col-lg-4 col-sm-6">
                  <div className="card db-card">
                    <div className="card-header">
                      <h4>
                        <i className="icon-materials"></i>
                        {t("bussiness_dashboard.agreements")}{" "}
                        <span className="badge badge-light">
                          {this.state.agreement.total}
                        </span>
                      </h4>
                    </div>
                    <div className="card-body">
                      <ul>
                        <li>
                          {t("bussiness_dashboard.Open")}{" "}
                          <span className="badge badge-light">
                            {this.state.agreement.open}
                          </span>
                        </li>
                        <li>
                          {t("bussiness_dashboard.Old")}{" "}
                          <span className="badge badge-light">
                            {this.state.agreement.old}
                          </span>
                        </li>
                        <li>
                          {t("bussiness_dashboard.Expired")}{" "}
                          <span className="badge badge-light">
                            {this.state.agreement.expired}
                          </span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div className="col-xl-3 col-lg-4 col-sm-6">
                  <div className="card db-card">
                    <div className="card-header">
                      <h4>
                        <i className="icon-work"></i>
                        {t("bussiness_dashboard.projects")}{" "}
                        <span className="badge badge-light">10</span>
                      </h4>
                    </div>
                    <div className="card-body">
                      <ul>
                        <li>
                          {t("bussiness_dashboard.Open")}{" "}
                          <span className="badge badge-light">60</span>
                        </li>
                        <li>
                          {t("bussiness_dashboard.Old")}{" "}
                          <span className="badge badge-light">40</span>
                        </li>
                        <li>
                          {t("bussiness_dashboard.Expired")}{" "}
                          <span className="badge badge-light">20</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div className="col-xl-3 col-lg-4 col-sm-6">
                  <div className="card db-card">
                    <div className="card-header">
                      <h4>
                        <i className="icon-jobs"></i>
                        {t("bussiness_dashboard.billing")}{" "}
                        <span className="badge badge-light">
                          {" "}
                          {this.state.invoice.total}
                        </span>
                      </h4>
                    </div>
                    <div className="card-body">
                      <ul>
                        <li>
                          {t("bussiness_dashboard.Open")}{" "}
                          <span className="badge badge-light">
                            {" "}
                            {this.state.invoice.open}
                          </span>
                        </li>
                        <li>
                          {t("bussiness_dashboard.Old")}{" "}
                          <span className="badge badge-light">
                            {" "}
                            {this.state.invoice.old}
                          </span>
                        </li>
                        <li>
                          {t("bussiness_dashboard.Expired")}{" "}
                          <span className="badge badge-light">
                            {" "}
                            {this.state.invoice.expired}
                          </span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div className="col-xl-3 col-lg-4 col-sm-6">
                  <div className="card db-card">
                    <div className="card-header">
                      <h4>
                        <i className="icon-work"></i>
                        {t("bussiness_dashboard.resources")}{" "}
                        <span className="badge badge-light">
                          {this.state.resource.total}
                        </span>
                      </h4>
                    </div>
                    <div className="card-body">
                      <ul>
                        <li>
                          {t("bussiness_dashboard.customers")}{" "}
                          <span className="badge badge-light">
                            {this.state.resource.customer}
                          </span>
                        </li>
                        <li>
                          {t("bussiness_dashboard.resources")}{" "}
                          <span className="badge badge-light">
                            {this.state.resource.resource}
                          </span>
                        </li>
                        <li>
                          {t("bussiness_dashboard.Expired")}{" "}
                          <span className="badge badge-light">
                            {this.state.resource.expired}
                          </span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div className="col-xl-3 col-lg-4 col-sm-6">
                  <div className="card db-card">
                    <div className="card-header">
                      <h4>
                        <i className="icon-offce-details"></i>
                        {t("bussiness_dashboard.requests")}{" "}
                        <span className="badge badge-light">
                          {this.state.request.total}
                        </span>
                      </h4>
                    </div>
                    <div className="card-body">
                      <ul>
                        <li>
                          {t("bussiness_dashboard.Open")}{" "}
                          <span className="badge badge-light">
                            {this.state.request.open}
                          </span>
                        </li>
                        <li>
                          {t("bussiness_dashboard.Old")}{" "}
                          <span className="badge badge-light">
                            {this.state.request.old}
                          </span>
                        </li>
                        <li>
                          {t("bussiness_dashboard.Expired")}{" "}
                          <span className="badge badge-light">
                            {this.state.request.expired}
                          </span>
                        </li>
                      </ul>
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

export default withTranslation()(Dashboard);
