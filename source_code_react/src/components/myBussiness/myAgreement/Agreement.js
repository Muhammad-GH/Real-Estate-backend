import React, { Component } from "react";
import axios from "axios";
import { Helper, url } from "../../../helper/helper";
import Header from "../../shared/Header";
import BussinessSidebar from "../../shared/BussinessSidebar";
import { Link } from "react-router-dom";
import { withTranslation } from "react-i18next";

class BusinessProposal extends Component {
  state = {
    feeds: [],
    proposal_id: 0,
    proposal_client_id: 0,
    proposal_client_type: "",
    drafts: [],
    agreement_client_id: 0,
    agreement_request_id: 0,
    draft: "",
  };

  componentDidMount = () => {
    this.loadProposal();
    this.loadDrafts();
  };

  loadProposal = async () => {
    const token = await localStorage.getItem("token");
    const response = await axios.get(`${url}/api/agreement/get/proposals`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    if (response.status === 200) {
      this.setState({ feeds: response.data });
    }
  };

  loadDrafts = async () => {
    const token = await localStorage.getItem("token");
    const response = await axios.get(`${url}/api/agreement/get/drafts`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    if (response.status === 200) {
      this.setState({ drafts: response.data });
    }
  };

  handleNameChange = (e) => {
    const { selectedIndex } = e.target.options;
    const { feeds } = this.state;
    const { proposal_id, proposal_client_id, proposal_client_type } = feeds[
      selectedIndex - 1
    ];
    this.setState({ proposal_id, proposal_client_id, proposal_client_type });
  };

  handleNameChange1 = (e) => {
    const { selectedIndex } = e.target.options;
    const { drafts } = this.state;
    const { agreement_client_id, agreement_request_id, draft } = drafts[
      selectedIndex - 1
    ];
    this.setState({ agreement_client_id, agreement_request_id, draft });
  };

  render() {
    const { t, i18n } = this.props;

    return (
      <div>
        <Header active={"bussiness"} />
        <div className="sidebar-toggle"></div>
        <nav aria-label="breadcrumb">
          <ol className="breadcrumb">
            <li className="breadcrumb-item ">{t("mycustomer.heading")}</li>
            <li className="breadcrumb-item ">
              {t("b_sidebar.agreement.agreement")}
            </li>
            <li className="breadcrumb-item active" aria-current="page">
              {t("c_material_list.listing.create")}
            </li>
          </ol>
        </nav>
        <div className="main-content">
          <BussinessSidebar dataFromParent={this.props.location.pathname} />
          <div className="page-content">
            <div className="container-fluid">
              <div
                className="card"
                style={{ maxWidth: "1120px", maxHeight: "70vh" }}
              >
                <div className="card-body">
                  <ul className="nav tablist">
                    <li className="nav-item">
                      <Link
                        className="nav-link"
                        to="/business-agreement-create"
                      >
                        {t("myproposal.scratch")}
                      </Link>
                    </li>
                    <li className="nav-item">
                      <a
                        className="nav-link"
                        data-toggle="collapse"
                        href="#request"
                        role="button"
                        aria-expanded="false"
                        aria-controls="request"
                      >
                        {t("myproposal.prop_request")}
                      </a>
                    </li>
                    <li className="nav-item">
                      <a
                        className="nav-link"
                        data-toggle="collapse"
                        href="#draft"
                        role="button"
                        aria-expanded="false"
                        aria-controls="draft"
                      >
                        {t("myagreement.agr_upd")}
                      </a>
                    </li>
                  </ul>
                  <div className="collapse" id="request">
                    <div className="modal-dialog modal-lg modal-visible">
                      <div className="modal-content">
                        <div className="modal-body">
                          <div className="form-group">
                            <label for="select-proposal" />
                            Select proposal / agreement
                            <div className="row">
                              <div className="col-md-8">
                                <select
                                  onChange={this.handleNameChange}
                                  id="select-agreement"
                                  className="form-control"
                                >
                                  <option>--Select--</option>
                                  {this.state.feeds.map(
                                    (
                                      {
                                        proposal_id,
                                        proposal_client_type,
                                        tender_title,
                                      },
                                      index
                                    ) => (
                                      <option>{`${tender_title}`}</option>
                                    )
                                  )}
                                </select>
                              </div>
                              <div className="col-md-4 mt-md-0 mt-4">
                                <Link
                                  className="btn btn-blue"
                                  to={{
                                    pathname: `/business-agreement-create/${this.state.proposal_id}/${this.state.proposal_client_type}`,
                                  }}
                                >
                                  Create Agreement
                                </Link>
                              </div>
                            </div>
                          </div>
                          <br />
                          <br />
                          <br />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div className="collapse" id="draft">
                    <div className="modal-dialog modal-lg modal-visible">
                      <div className="modal-content">
                        <div className="modal-body">
                          <div className="form-group">
                            <label for="select-proposal" />
                            Select proposal / agreement
                            <div className="row">
                              <div className="col-md-8">
                                <select
                                  onChange={this.handleNameChange1}
                                  id="select-agreement"
                                  className="form-control"
                                >
                                  <option>--Select--</option>
                                  {this.state.drafts.map(
                                    (
                                      {
                                        agreement_request_id,
                                        agreement_client_type,
                                        agreement_names,
                                      },
                                      index
                                    ) => (
                                      <option>{`${agreement_names}`}</option>
                                    )
                                  )}
                                </select>
                              </div>
                              <div className="col-md-4 mt-md-0 mt-4">
                                <Link
                                  className="btn btn-blue"
                                  to={{
                                    pathname: `/business-agreement-create/${this.state.agreement_request_id}/${this.state.agreement_client_id}/${this.state.draft}`,
                                  }}
                                >
                                  Update Agreement
                                </Link>
                              </div>
                            </div>
                          </div>
                          <br />
                          <br />
                          <br />
                        </div>
                      </div>
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

export default withTranslation()(BusinessProposal);
