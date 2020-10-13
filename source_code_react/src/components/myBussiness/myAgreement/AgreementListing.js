import React, { Component } from "react";
import axios from "axios";
import Header from "../../shared/Header";
import BussinessSidebar from "../../shared/BussinessSidebar";
import { Helper, url } from "../../../helper/helper";
import { Link } from "react-router-dom";
import AgreementProposalModal from "../../myBussiness/modals/AgreementProposalModal";
import { withTranslation } from "react-i18next";

class AgreementListing extends Component {
  state = {
    agreements: [],
    changed: false,
    properties: [],
    agreement_id: 0,
    search: null,
  };

  componentDidMount = async () => {
    this.loadAgreements();
  };

  componentDidUpdate = async (prevProps, prevState) => {
    if (prevState.changed !== this.state.changed) {
      this.loadAgreements();
    }
  };

  viewProposal = async (...args) => {
    this.setState({
      properties: args,
      agreement_id: args[5],
    });
  };

  loadAgreements = async () => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/agreement/get`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        // const { data } = result.data;
        // this.feeds_search = data;
        this.setState({ agreements: result.data });
      })
      .catch((err) => {
        console.log(err.response);
      });
  };

  handleSubmit = async (...args) => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/agreement/upd/${args[0]}/${args[1]}/${args[2]}`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        window.location.reload();
      })
      .catch((err) => {
        console.log(err.response);
      });
  };
  searchSpace = (event) => {
    this.setState({ search: event.target.value });
  };

  render() {
    const agreementsList = this.state.agreements.filter((data) => {
      if (this.state.search == null) return data;
      else if (
        data.agreement_request_id.toString().includes(this.state.search) ||
        data.agreement_names
          .toLowerCase()
          .includes(this.state.search.toLowerCase())
      )
        return data;
    });
    const agreement = agreementsList.map(
      ({
        agreement_id,
        agreement_request_id,
        agreement_client_id,
        agreement_client_type,
        agreement_status,
        agreement_client_email,
        sender_isLogged,
        agreement_pdf,
        agreement_names,
        agreement_notif: {
          notification_message,
          notification_sender_id,
          notification_bid_id,
          notification_user_id,
          notification_table_name,
          notification_id,
        },
      }) => (
        <tr key={agreement_id}>
          <td style={{ width: "50px" }}>
            <div className="form-check">
              <input
                type="checkbox"
                className="form-check-input"
                id={`check2${agreement_id}`}
              />
              <label
                className="form-check-label"
                htmlFor={`check2${agreement_id}`}
              ></label>
            </div>
          </td>
          <td data-label="Request ID: ">{agreement_request_id}</td>
          <td data-label="AgreeName: ">{agreement_names}</td>
          <td data-label="Type: ">{agreement_client_type}</td>
          <td data-label="Email: ">{agreement_client_email}</td>
          <td data-label="Message: ">{notification_message}</td>
          <td data-label="Status: ">
            {agreement_status === 0
              ? "Draft"
              : agreement_status === 1
              ? "Send"
              : agreement_status === 2
              ? "Accepted"
              : agreement_status === 3
              ? "Declined"
              : agreement_status === 4
              ? "Revision"
              : null}
          </td>
          <td data-label="PDF: ">
            <button
              onClick={(e) =>
                window.open(
                  `${url}/images/marketplace/agreement/pdf/${agreement_pdf}`,
                  "_blank"
                )
              }
              type="button"
              class="btn btn-outline-dark mt-3"
              style={{ marginRight: "20px" }}
            >
              PDF
            </button>
          </td>
          <td data-label="Action: ">
            {sender_isLogged ? (
              <div
                style={{
                  display: "flex",
                }}
              >
                {agreement_status === 4 ? (
                  <div>
                    <Link
                      to={{
                        pathname: `/business-agreement-create/${agreement_request_id}/${agreement_client_id}/update`,
                      }}
                      type="button"
                      class="btn btn-outline-dark mt-3"
                      style={{ marginRight: "20px" }}
                    >
                      Edit
                    </Link>
                    <button
                      onClick={() =>
                        this.viewProposal(
                          notification_sender_id,
                          notification_bid_id,
                          notification_user_id,
                          notification_table_name,
                          notification_id,
                          agreement_id,
                          3
                        )
                      }
                      data-toggle="modal"
                      data-target="#agreement-proposal"
                      type="button"
                      class="btn btn-outline-danger mt-3"
                      style={{ marginRight: "20px" }}
                    >
                      Decline
                    </button>
                  </div>
                ) : null}
                <button
                  onClick={() =>
                    this.viewProposal(
                      notification_sender_id,
                      notification_bid_id,
                      notification_user_id,
                      notification_table_name,
                      notification_id,
                      agreement_id,
                      4
                    )
                  }
                  data-toggle="modal"
                  data-target="#agreement-proposal"
                  type="button"
                  class="btn btn-outline-primary mt-3 mr-4"
                >
                  View message
                </button>

                {agreement_client_type === "resource" &&
                agreement_status === 1 ? (
                  <React.Fragment>
                    <button
                      onClick={() =>
                        this.handleSubmit(agreement_id, "pro_agreement", 2)
                      }
                      className="btn btn-outline-dark mt-3 mr-4"
                    >
                      Accept
                    </button>
                    <button
                      onClick={() =>
                        this.handleSubmit(agreement_id, "pro_agreement", 3)
                      }
                      className="btn btn-outline-dark mt-3 mr-4"
                    >
                      Decline
                    </button>

                    <Link
                      to={{
                        pathname: `/business-propsal-create/${agreement_request_id}/${agreement_client_id}/update`,
                      }}
                      type="button"
                      class="btn btn-outline-dark mt-3 mr-4"
                      style={{ marginRight: "20px" }}
                    >
                      Revise
                    </Link>
                  </React.Fragment>
                ) : null}

                <AgreementProposalModal
                  propsObj={this.state.properties}
                  proposal_id={this.state.agreement_id}
                  table={"pro_agreement"}
                />
              </div>
            ) : (
              <div
                style={{
                  display: "flex",
                }}
              >
                {agreement_status === 1 ? (
                  <div>
                    <button
                      type="button"
                      onClick={() =>
                        this.viewProposal(
                          notification_sender_id,
                          notification_bid_id,
                          notification_user_id,
                          notification_table_name,
                          notification_id,
                          agreement_id,
                          2
                        )
                      }
                      data-toggle="modal"
                      data-target="#agreement-proposal"
                      class="btn btn-outline-success mt-3"
                      style={{ marginRight: "20px" }}
                    >
                      Accept
                    </button>
                    <button
                      type="button"
                      onClick={() =>
                        this.viewProposal(
                          notification_sender_id,
                          notification_bid_id,
                          notification_user_id,
                          notification_table_name,
                          notification_id,
                          agreement_id,
                          3
                        )
                      }
                      data-toggle="modal"
                      data-target="#agreement-proposal"
                      class="btn btn-outline-danger mt-3"
                      style={{ marginRight: "20px" }}
                    >
                      Decline
                    </button>
                  </div>
                ) : null}
                <button
                  onClick={() =>
                    this.viewProposal(
                      notification_sender_id,
                      notification_bid_id,
                      notification_user_id,
                      notification_table_name,
                      notification_id,
                      agreement_id,
                      4
                    )
                  }
                  data-toggle="modal"
                  data-target="#agreement-proposal"
                  type="button"
                  class="btn btn-outline-dark mt-3"
                >
                  Revise
                </button>
                <AgreementProposalModal
                  propsObj={this.state.properties}
                  proposal_id={this.state.agreement_id}
                  table={"pro_agreement"}
                />
              </div>
            )}
          </td>
        </tr>
      )
    );

    const { t, i18n } = this.props;

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
              {t("b_sidebar.agreement.agreement")}
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
                          <label htmlFor="name">
                            {t("myagreement.agreement_req_id")}
                          </label>
                          <input
                            id="name"
                            type="text"
                            className="form-control"
                            onChange={this.searchSpace}
                          />
                        </div>
                      </div>
                      {/* <div className="col-lg-5 col-md-6">
                    <div className="form-group">
                      <label htmlFor="type">Client Type</label>
                      <select
                        name="type"
                        id="type"
                        className="form-control"
                      >
                        <option>--Select--</option>
                      </select>
                    </div>
                  </div> */}
                    </div>
                  </div>
                </div>
              </div>
              <div className="card">
                <div className="card-header">
                  <h2 className="head2">
                    {t("c_material_list.listing.my_listings")}
                  </h2>
                  <div className="btn-group">
                    <Link
                      className="btn btn-blue text-uppercase"
                      to="/myagreement"
                    >
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
                          <th>{t("c_material_list.listing.ref")}</th>
                          <th>{t("myproposal.prop_name")}</th>
                          <th>{t("c_material_list.listing.type")}</th>
                          <th>{t("account.email")}</th>
                          <th>{t("myproposal.message")}</th>
                          <th>{t("account.status")}</th>
                          <th>{t("myproposal.Message")}</th>
                          <th>{t("myproposal.action")}</th>
                        </tr>
                      </thead>
                      <tbody>{agreement}</tbody>
                    </table>
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

export default withTranslation()(AgreementListing);
