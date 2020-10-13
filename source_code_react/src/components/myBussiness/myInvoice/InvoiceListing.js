import React, { Component } from "react";
import axios from "axios";
import Header from "../../shared/Header";
import BussinessSidebar from "../../shared/BussinessSidebar";
import SendInvoice from "../modals/SendInvoice";
import { url } from "../../../helper/helper";
import { Link } from "react-router-dom";
import Datetime from "react-datetime";
import moment from "moment";
import { withTranslation } from "react-i18next";

class InvoiceListing extends Component {
  feeds_search = [];

  state = {
    resources: [],
    search: null,
    // type: "",
    pdf: null,

    left: null,
    right: null,
  };

  componentDidMount = async () => {
    this.loadResources();
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

  loadResources = async () => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/invoice/get`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        const { data } = result.data;
        this.feeds_search = data;
        this.setState({ resources: data });
      })
      .catch((err) => {
        console.log(err.response);
      });
  };

  searchDate = (event) => {
    this.setState({ resources: this.feeds_search });
    this.setState((prevstate) => ({
      resources: prevstate.resources.filter((data) => {
        return data.date.includes(moment(event._d).format("DD-MM-YYYY"));
      }),
    }));
  };

  searchSpace = (event) => {
    let keyword = event.target.value;
    this.setState({ search: keyword });
  };

  downloadPDF = async (id) => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/invoice/download/${id}`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        this.setState({ pdf: result.data });
        window.open(
          `${url}/images/marketplace/invoice/pdf/${result.data}`,
          "_blank"
        );
      })
      .catch((err) => {
        console.log(err.response);
      });
  };

  sendPDF = (id) => {
    this.downloadPDF(id);
  };

  render() {
    const { t, i18n } = this.props;

    const items = this.state.resources.filter((data) => {
      if (this.state.search == null) return data;
      else if (
        data.email.includes(this.state.search) ||
        data.invoice_names
          .toLowerCase()
          .includes(this.state.search.toLowerCase())
      ) {
        return data;
      }
    });

    const resource = items.map((resource, index) => (
      <tr key={index}>
        <td style={{ width: "50px" }}>
          <div className="form-check">
            <input
              type="checkbox"
              className="form-check-input"
              id={`check2${index}`}
            />
            <label
              className="form-check-label"
              htmlFor={`check2${index}`}
            ></label>
          </div>
        </td>
        <td>{resource.invoice_number}</td>
        <td>{resource.invoice_names}</td>
        <td>{resource.acc_no}</td>
        <td>{resource.client_type}</td>
        <td>{resource.email}</td>
        <td>{resource.date}</td>
        {/* <td>{resource.agreement_names}</td> */}
        <td>
          {this.state.left} {resource.total} {this.state.right}
        </td>
        <td>
          <button
            onClick={() => this.downloadPDF(resource.id)}
            className="btn btn-dark"
            style={{ marginRight: "10px" }}
          >
            <i className="icon-attachment"></i>Download
          </button>
          <button
            onClick={() => this.sendPDF(resource.id)}
            className="btn btn-light"
            data-toggle="modal"
            data-target="#send-invoice"
          >
            <i className="icon-attachment"></i>Send
          </button>
        </td>
      </tr>
    ));

    return (
      <div>
        <Header active={"bussiness"} />
        <div className="sidebar-toggle"></div>
        <nav aria-label="breadcrumb">
          <ol className="breadcrumb">
            <li className="breadcrumb-item active" aria-current="page">
              {t("mycustomer.heading")}
            </li>
            <li className="breadcrumb-item active" aria-current="page">
              {t("invoice.heading")}
            </li>
          </ol>
        </nav>
        <div className="main-content">
          <BussinessSidebar dataFromParent={this.props.location.pathname} />
          <div className="page-content">
            <div className="container-fluid">
              <h3 className="head3">{t("feeds.search.title")}</h3>
              <div className="card">
                <div className="card-body">
                  <div className="filter">
                    <div className="row align-items-center">
                      <div className="col-lg-4 col-md-6">
                        <div className="form-group">
                          <label htmlFor="date">{t("myproposal.date")}</label>
                          <Datetime
                            id="date"
                            name="date"
                            onChange={(date) => this.searchDate(date)}
                            dateFormat="DD-MM-YYYY"
                            timeFormat={false}
                          />
                        </div>
                      </div>
                      <div className="col-lg-5 col-md-6">
                        <div className="form-group">
                          <label htmlFor="client">
                            {`${t("invoice.client")} / ${t("invoice.name")}`}
                          </label>
                          <input
                            id="client"
                            onChange={this.searchSpace}
                            type="text"
                            className="form-control"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div className="card">
                <div className="card-header">
                  <h2 className="head2">{t("invoice.heading")}</h2>
                  <div className="btn-group">
                    <Link className="btn btn-blue text-uppercase" to="/invoice">
                      {t("c_material_list.listing.create")}
                    </Link>
                  </div>
                </div>
                <div className="card-body">
                  <div className="table-responsive">
                    <table className="table">
                      <thead>
                        <tr style={{ fontSize: "15px" }}>
                          <th style={{ width: "50px" }}>
                            <div className="form-check">
                              <input
                                type="checkbox"
                                className="form-check-input"
                                id="check1"
                              />
                              <label
                                className="form-check-label"
                                htmlFor="check1"
                              ></label>
                            </div>
                          </th>
                          <th>{t("invoice.invoice")} #</th>
                          <th>{t("myproposal.prop_name")}</th>
                          <th>{t("invoice.account")} #</th>
                          <th>{t("c_material_list.listing.type")} </th>
                          <th>{t("account.email")}</th>
                          <th>{t("myproposal.date")}</th>
                          <th>{t("invoice.total")}</th>
                        </tr>
                      </thead>
                      <tbody> {resource} </tbody>
                    </table>
                  </div>

                  <SendInvoice pdf={this.state.pdf} />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

export default withTranslation()(InvoiceListing);
