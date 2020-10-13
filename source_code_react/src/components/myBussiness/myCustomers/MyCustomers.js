import React, { Component } from "react";
import axios from "axios";
import Header from "../../shared/Header";
import BussinessSidebar from "../../shared/BussinessSidebar";
import { Helper, url } from "../../../helper/helper";
import Alert from "react-bootstrap/Alert";
import { withTranslation } from "react-i18next";

class MyResources extends Component {
  state = {
    first_name: "",
    last_name: "",
    phone: "",
    email: "",
    company: "",
    type: "",
    success: 0,
    errors: [],
  };

  componentDidMount = (params) => {
    this.myRef = React.createRef();
    this.loadData();
  };

  loadData = async () => {
    if (this.props.match.params.id) {
      const token = await localStorage.getItem("token");
      const response = await axios.get(
        `${url}/api/resource/${this.props.match.params.id}`,
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        }
      );
      if (response.status === 200) {
        const {
          first_name,
          last_name,
          email,
          company,
          type,
          phone,
        } = response.data.data;
        this.setState({
          first_name: first_name,
          last_name: last_name,
          email: email,
          company: company,
          type: type,
          phone,
        });
      }
    }
  };

  handleSubmit = async (event) => {
    event.preventDefault();
    const token = await localStorage.getItem("token");

    const data = new FormData();
    data.set("first_name", this.state.first_name);
    data.set("last_name", this.state.last_name);
    data.set("phone", this.state.phone);
    data.set("email", this.state.email);
    data.set("company", this.state.company);
    data.set("type", this.state.type);
    axios
      .post(`${url}/api/resources`, data, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((res) => {
        this.setState({ success: 1 });
        this.myRef.current.scrollTo(0, 0);
      })
      .catch((err) => {
        Object.entries(err.response.data.error).map(([key, value]) => {
          this.setState({ errors: err.response.data.error });
        });
        this.setState({ success: 2 });
        this.myRef.current.scrollTo(0, 0);
      });
  };

  handleUpdate = async (event) => {
    event.preventDefault();
    const token = await localStorage.getItem("token");

    const params = {
      first_name: this.state.first_name,
      last_name: this.state.last_name,
      email: this.state.email,
      company: this.state.company,
      type: this.state.type,
      phone: this.state.phone,
    };

    const response = await axios.put(
      `${url}/api/resource/update/${this.props.match.params.id}`,
      null,
      {
        params: params,
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
    );
    if (response.status === 200) {
      this.setState({ success: 1 });
      this.myRef.current.scrollTo(0, 0);
    }
  };

  handleChange = (event) => {
    const { name, value } = event.target;
    this.setState({ [name]: value });
  };

  render() {
    const { t, i18n } = this.props;

    let alert;
    if (this.state.success === 1) {
      alert = (
        <Alert variant="success" style={{ fontSize: "13px" }}>
          {this.props.match.params.id
            ? t("success.cus_upd")
            : t("success.cus_ins")}
        </Alert>
      );
    } else if (this.state.success === 2) {
      alert = (
        <Alert variant="danger" style={{ fontSize: "13px" }}>
          {Object.entries(this.state.errors).map(([key, value]) => {
            const stringData = value.reduce((result, item) => {
              return `${item} `;
            }, "");
            return stringData;
          })}
        </Alert>
      );
    }
    return (
      <div>
        <Header active={"bussiness"} />
        <div class="sidebar-toggle"></div>
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
          <div ref={this.myRef} className="page-content">
            {alert ? alert : null}
            <div className="container-fluid">
              <h3 className="head3" style={{ paddingBottom: "1%" }}>
                {t("b_sidebar.cus.create_customers")}
              </h3>

              <div className="card" style={{ maxWidth: "1120px" }}>
                <form
                  onSubmit={
                    this.props.match.params.id
                      ? this.handleUpdate
                      : this.handleSubmit
                  }
                >
                  <div class="card-body">
                    <div className="mt-3"></div>
                    <div className="row">
                      <div className="col-xl-4 col-lg-5 col-md-6">
                        <div className="form-group">
                          <label for="first_name">
                            {t("account.first_name")}
                          </label>
                          <input
                            id="first_name"
                            name="first_name"
                            onChange={this.handleChange}
                            className="form-control"
                            type="text"
                            value={this.state.first_name}
                          />
                        </div>
                      </div>
                      <div className="col-xl-4 col-lg-5 col-md-6 offset-xl-1">
                        <div className="form-group">
                          <label for="last_name">
                            {t("account.last_name")}
                          </label>
                          <input
                            id="last_name"
                            name="last_name"
                            onChange={this.handleChange}
                            className="form-control"
                            type="text"
                            value={this.state.last_name}
                          />
                        </div>
                      </div>
                      <div className="col-xl-4 col-lg-5 col-md-6">
                        <div className="form-group">
                          <label for="email">{t("account.email")}</label>
                          <input
                            id="email"
                            name="email"
                            onChange={this.handleChange}
                            className="form-control"
                            type="email"
                            value={this.state.email}
                          />
                        </div>
                      </div>
                      <div className="col-xl-4 col-lg-5 col-md-6 offset-xl-1">
                        <div className="form-group">
                          <label for="company">{t("account.company")}</label>
                          <input
                            id="company"
                            name="company"
                            onChange={this.handleChange}
                            className="form-control"
                            type="text"
                            value={this.state.company}
                          />
                        </div>
                      </div>
                      <div className="col-xl-4 col-lg-5 col-md-6">
                        <div className="form-group">
                          <label for="type">{t("account.type")}</label>
                          <select
                            onChange={this.handleChange}
                            name="type"
                            id="type"
                            class="form-control"
                            placeholder={this.state.type}
                          >
                            <option value="">--Select--</option>
                            <option value="Client">Client</option>
                          </select>
                        </div>
                      </div>

                      <div className="col-xl-4 col-lg-5 col-md-6 offset-xl-1">
                        <div className="form-group">
                          <label for="company">{t("account.phone")}</label>
                          <input
                            id="phone"
                            name="phone"
                            onChange={this.handleChange}
                            className="form-control"
                            type="number"
                            value={this.state.phone}
                          />
                        </div>
                      </div>
                    </div>

                    <div className="col-xl-3 col-lg-12">
                      <div className="form-group">
                        <label className="d-none d-xl-block">&nbsp;</label>
                        <div className="clear"></div>
                        <button className="btn btn-success">Create</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

export default withTranslation()(MyResources);
