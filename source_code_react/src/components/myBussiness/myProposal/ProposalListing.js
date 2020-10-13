import React, { Component } from "react";
import axios from "axios";
import Header from "../../shared/Header";
import BussinessSidebar from "../../shared/BussinessSidebar";
import { Helper, url } from "../../../helper/helper";
import { Link } from "react-router-dom";
import AgreementProposalModal from "../../myBussiness/modals/AgreementProposalModal";
import { withTranslation } from "react-i18next";

class ProposalListing extends Component {
  state = {
    proposals: [],
    changed: false,
    properties: [],
    proposal_id: 0,
    search: null,
  };

  componentDidMount = async () => {
    this.loadProposals();
  };

  componentDidUpdate = async (prevProps, prevState) => {
    if (prevState.changed !== this.state.changed) {
      this.loadProposals();
    }
  };

  viewProposal = async (...args) => {
    this.setState({
      properties: args,
      proposal_id: args[5],
    });
  };

  handleSubmit = async (...args) => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/proposal/upd/${args[0]}/${args[1]}/${args[2]}`, {
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

  loadProposals = async () => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/proposal/get`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        this.setState({ proposals: result.data });
      })
      .catch((err) => {
        console.log(err.response);
      });
  };
  searchSpace = (event) => {
    this.setState({ search: event.target.value });
  };

  render() {
    const { t, i18n } = this.props;
    const proposalsList = this.state.proposals.filter((data) => {
      if (this.state.search == null) return data;
      else if (
        data.proposal_request_id.toString().includes(this.state.search) ||
        data.proposal_names
          .toLowerCase()
          .includes(this.state.search.toLowerCase())
      )
        return data;
    });

    const proposal = proposalsList.map(
      ({
        proposal_id,
        proposal_request_id,
        proposal_client_id,
        proposal_client_type,
        proposal_status,
        proposal_client_email,
        sender_isLogged,
        proposal_pdf,
        proposal_names,
        proposal_notif: {
          notification_message,
          notification_sender_id,
          notification_bid_id,
          notification_user_id,
          notification_table_name,
          notification_id,
        },
      }) => (
        <tr key={proposal_id}>
          <td style={{ width: "50px" }}>
            <div className="form-check">
              <input
                type="checkbox"
                className="form-check-input"
                id={`check2${proposal_id}`}
              />
              <label
                className="form-check-label"
                htmlFor={`check2${proposal_id}`}
              ></label>
            </div>
          </td>
          <td data-label="Request ID: ">{proposal_request_id}</td>
          <td data-label="PropName: ">{proposal_names}</td>
          <td data-label="Type: ">{proposal_client_type}</td>
          <td data-label="Email: ">{proposal_client_email}</td>
          <td data-label="Message: ">{notification_message}</td>
          <td data-label="Status: ">
            {proposal_status === 0
              ? "Draft"
              : proposal_status === 1
              ? "Send"
              : proposal_status === 2
              ? "Accepted"
              : proposal_status === 3
              ? "Declined"
              : proposal_status === 4
              ? "Revision"
              : null}
          </td>
          <td data-label="PDF: ">
            <button
              onClick={(e) =>
                window.open(
                  `${url}/images/marketplace/proposal/pdf/${proposal_pdf}`,
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
                {proposal_status === 4 ? (
                  <div>
                    <Link
                      to={{
                        pathname: `/business-propsal-create/${proposal_request_id}/${proposal_client_id}/update`,
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
                          proposal_id,
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
                      proposal_id,
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
                {proposal_client_type === "resource" &&
                proposal_status === 1 ? (
                  <React.Fragment>
                    <button
                      onClick={() =>
                        this.handleSubmit(proposal_id, "pro_proposal", 2)
                      }
                      className="btn btn-outline-dark mt-3 mr-4"
                    >
                      Accept
                    </button>
                    <button
                      onClick={() =>
                        this.handleSubmit(proposal_id, "pro_proposal", 3)
                      }
                      className="btn btn-outline-dark mt-3 mr-4"
                    >
                      Decline
                    </button>

                    <Link
                      to={{
                        pathname: `/business-propsal-create/${proposal_request_id}/${proposal_client_id}/update`,
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
                  proposal_id={this.state.proposal_id}
                  table={"pro_proposal"}
                />
              </div>
            ) : (
              <div
                style={{
                  display: "flex",
                }}
              >
                {proposal_status === 1 ? (
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
                          proposal_id,
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
                          proposal_id,
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
                      proposal_id,
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
                  proposal_id={this.state.proposal_id}
                  table={"pro_proposal"}
                />
                <br />
              </div>
            )}
          </td>
        </tr>
      )
    );

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
              {t("b_sidebar.proposal.proposal")}
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
                            {t("myproposal.prop_req_id")}
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
                      to="/myproposal"
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
                      <tbody>{proposal}</tbody>
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

export default withTranslation()(ProposalListing);
