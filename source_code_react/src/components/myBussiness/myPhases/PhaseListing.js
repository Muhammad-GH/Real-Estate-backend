import React, { Component } from "react";
import axios from "axios";
import Header from "../../shared/Header";
import BussinessSidebar from "../../shared/BussinessSidebar";
import { url } from "../../../helper/helper";
import { Link } from "react-router-dom";
import Datetime from "react-datetime";
import { withTranslation } from "react-i18next";

class PhaseListing extends Component {
  state = {
    search: null,
    phases: [],
  };

  componentDidMount = () => {
    this.loadPhases();
  };

  loadPhases = async () => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/phase/work/en`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        this.setState({ phases: result.data.data });
      })
      .catch((err) => {
        console.log(err.response);
      });
  };

  deletePhase = async (id) => {
    const token = await localStorage.getItem("token");
    axios
      .delete(`${url}/api/phase/work_delete/${id}`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        this.loadPhases();
      })
      .catch((err) => {
        console.log(err.response);
      });
  };

  render() {
    const { t, i18n } = this.props;
    const items = this.state.phases.filter((data) => {
      if (this.state.search == null) return data;
      // else if (
      //   data.email.includes(this.state.search) ||
      //   data.invoice_names
      //     .toLowerCase()
      //     .includes(this.state.search.toLowerCase())
      // ) {
      //   return data;
      // }
    });
    const phaseList = items.map((phase, index) => (
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
        <td>{phase.aw_area_id}</td>
        <td>{phase.aw_identifier}</td>
        <td>{phase.area_identifier}</td>
        <td>
          <Link
            className="btn btn-dark"
            style={{ marginRight: "10px" }}
            to={{
              pathname: `/myphases/${phase.aw_id}`,
            }}
          >
            Edit
          </Link>
          <button
            onClick={() => this.deletePhase(phase.aw_area_id)}
            className="btn btn-danger"
          >
            Delete
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
              {t("phase.list_phase")}
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
                          <label htmlFor="Name">{`${t("invoice.name")}`}</label>
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
                  <h2 className="head2">{t("phase.list_phase")}</h2>
                  <div className="btn-group">
                    <Link
                      className="btn btn-blue text-uppercase"
                      to="/myphases"
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
                          <th>{t("phase.phase")} #</th>
                          <th>{t("phase.work_area")}</th>
                          <th>{t("phase.area_name")}</th>
                          <th> </th>
                        </tr>
                      </thead>
                      <tbody> {phaseList} </tbody>
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

export default withTranslation()(PhaseListing);
