/* eslint-disable no-unused-vars */
import React, { Component } from "react";
import axios from "axios";
import Header from "../../shared/Header";
import BussinessSidebar from "../../shared/BussinessSidebar";
import { Helper, url } from "../../../helper/helper";
import { Link } from "react-router-dom";
import { withTranslation } from "react-i18next";

class ResourceListing extends Component {
  feeds_search = [];

  state = {
    resources: [],
    search: null,
    type: "",
  };

  componentDidMount = async () => {
    this.loadResources();
  };

  loadResources = async () => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/resources-list/Client`, {
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

  handleDelete = async (id) => {
    const token = await localStorage.getItem("token");
    const response = await axios.delete(`${url}/api/resource/delete/${id}`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    if (response.status === 200) {
      window.location.reload();
    }
  };

  searchSpace = (event) => {
    let keyword = event.target.value;
    this.setState({ search: keyword });
  };

  handleChange = (event) => {
    this.setState({ resources: this.feeds_search });
    this.setState({ type: event.target.value }, () => {
      if (this.state.type == "--Select--") {
        window.location.reload();
      }
      this.setState((prevstate) => ({
        resources: prevstate.resources.filter((data) => {
          return data.type.includes(this.state.type);
        }),
      }));
    });
  };

  render() {
    const { t, i18n } = this.props;

    const items = this.state.resources.filter((data) => {
      if (this.state.search == null) return data;
      else if (
        data.first_name
          .toLowerCase()
          .includes(this.state.search.toLowerCase()) ||
        data.company.toLowerCase().includes(this.state.search.toLowerCase())
      ) {
        return data;
      }
    });

    const resource = items.map((resource) => (
      <tr key={resource.id}>
        <td style={{ width: "50px" }}>
          <div className="form-check">
            <input
              type="checkbox"
              className="form-check-input"
              id={`check2${resource.id}`}
            />
            <label
              className="form-check-label"
              htmlFor={`check2${resource.id}`}
            ></label>
          </div>
        </td>
        <td data-label="First Name: ">{resource.first_name}</td>
        <td data-label="Last Name: ">{resource.last_name}</td>
        <td data-label="Phone: ">{resource.phone}</td>
        <td data-label="Email: ">{resource.email}</td>
        <td data-label="Company: ">{resource.company}</td>
        <td data-label="Type: ">{resource.type}</td>
        <td data-label="Status: ">
          {resource.status === 1 ? "Active" : "Inactive"}
        </td>
        <td data-label="View: ">
          <Link
            to={{ pathname: `mycustomers/${resource.id}` }}
            className="btn btn-info"
          >
            <i className="icon-edit"></i>Details
          </Link>
        </td>
        <td data-label="Delete: ">
          <button
            onClick={(e) => this.handleDelete(resource.id)}
            className="btn btn-light"
          >
            <i className="icon-trash"></i>Delete
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
              {t("mycustomer.heading_2")}
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
                            {t("mycustomer.resource_company")}
                          </label>
                          <input
                            id="name"
                            onChange={this.searchSpace}
                            type="text"
                            className="form-control"
                          />
                        </div>
                      </div>
                      <div className="col-lg-5 col-md-6">
                        <div className="form-group">
                          <label htmlFor="type">
                            {t("mycustomer.resource_type")}
                          </label>
                          <select
                            name="type"
                            id="type"
                            onChange={this.handleChange}
                            className="form-control"
                          >
                            <option>--Select--</option>
                            <option>Sub Contractor</option>
                            <option>Supplier</option>
                            <option>Client</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div className="card">
                <div className="card-header">
                  <h2 className="head2">My listings</h2>
                  <div className="btn-group">
                    <Link
                      className="btn btn-blue text-uppercase"
                      to="/mycustomers"
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
                          <th>{t("account.first_name")}</th>
                          <th>{t("account.last_name")}</th>
                          <th>{t("account.phone")}</th>
                          <th>{t("account.email")}</th>
                          <th>{t("account.company")}</th>
                          <th>{t("account.type")}</th>
                          <th>{t("account.status")}</th>
                        </tr>
                      </thead>
                      <tbody>{resource}</tbody>
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

export default withTranslation()(ResourceListing);
