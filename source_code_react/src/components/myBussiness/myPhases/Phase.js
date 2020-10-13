import React, { Component } from "react";
import axios from "axios";
import { url } from "../../../helper/helper";
import Header from "../../shared/Header";
import BussinessSidebar from "../../shared/BussinessSidebar";
import Alert from "react-bootstrap/Alert";
import { withTranslation } from "react-i18next";

class Phase extends Component {
  state = {
    area_name: "",
    _area_id: 0,
    _area_work_id: 0,
    area: [],
    area_work: "",
    area_phase: "",
    success: 0,
    errors: [],
  };

  componentDidMount = () => {
    this.myRef = React.createRef();
    this.loadPhaseList();
    if (this.props.match.params.id) {
      this.loadPhaseEdit();
    }
  };

  handleChange = (e) => {
    const { name, value } = e.target;
    this.setState({ [name]: value });
  };

  loadPhaseEdit = async () => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/phase/work_edit/${this.props.match.params.id}`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        const {
          area_id,
          area_identifier,
          aw_id,
          aw_identifier,
        } = result.data.data[0];

        this.setState({
          area_name: area_identifier,
          _area_id: area_id,
          area_phase: area_id,
          _area_work_id: aw_id,
          area_work: aw_identifier,
        });
      })
      .catch((err) => {
        alert("Error occured please login again");
      });
  };

  loadPhaseList = async () => {
    const token = await localStorage.getItem("token");
    let lang = localStorage.getItem("_lng");
    axios
      .get(`${url}/api/phase/list/${lang}`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        this.setState({ area: result.data.data });
      })
      .catch((err) => {
        alert("Error occured please login again");
      });
  };

  handleAreaSubmit = async (e) => {
    e.preventDefault();
    const token = await localStorage.getItem("token");

    const data = new FormData();
    data.set("area_name", this.state.area_name);
    axios
      .post(`${url}/api/phase/area`, data, {
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

  handleAreaUpdate = async (e) => {
    e.preventDefault();
    const token = await localStorage.getItem("token");

    const params = {
      area_identifier: this.state.area_name,
    };

    axios
      .put(`${url}/api/phase/area_update/${this.state._area_id}`, null, {
        params: params,
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

  handleAreaPhaseSubmit = async (e) => {
    e.preventDefault();
    const token = await localStorage.getItem("token");

    const data = new FormData();
    data.set("aw_area_id", this.state.area_phase);
    data.set("aw_identifier", this.state.area_work);
    axios
      .post(`${url}/api/phase/work`, data, {
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

  handleAreaPhaseUpdate = async (e) => {
    e.preventDefault();
    const token = await localStorage.getItem("token");

    const params = {
      aw_identifier: this.state.area_work,
    };

    axios
      .put(`${url}/api/phase/work_update/${this.state._area_work_id}`, null, {
        params: params,
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

  render() {
    const { t } = this.props;

    let alert;
    if (this.state.success === 1) {
      alert = (
        <Alert variant="success" style={{ fontSize: "13px" }}>
          {this.props.match.params.id
            ? t("success.phase_upd")
            : t("success.phase_ins")}
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
        <div className="sidebar-toggle"></div>
        <nav aria-label="breadcrumb">
          <ol className="breadcrumb">
            <li className="breadcrumb-item ">{t("mycustomer.heading")}</li>
            <li className="breadcrumb-item ">{t("phase.phase")}</li>
            <li className="breadcrumb-item active" aria-current="page">
              {t("c_material_list.listing.create")}
            </li>
          </ol>
        </nav>
        <div className="main-content">
          <BussinessSidebar dataFromParent={this.props.location.pathname} />
          <div ref={this.myRef} className="page-content">
            {alert ? alert : null}
            <div className="container-fluid">
              <h3 className="head3">{t("phase.create_phase")}</h3>
              <div className="card" style={{ maxWidth: "1120px" }}>
                <form
                  onSubmit={
                    this.props.match.params.id
                      ? this.handleAreaUpdate
                      : this.handleAreaSubmit
                  }
                >
                  <div className="card-body">
                    <div className="mt-3"></div>
                    <div className="row">
                      <div className="col-xl-4 col-lg-5 col-md-6">
                        <div className="form-group">
                          <label for="area_name">{t("phase.area_name")}</label>
                          <input
                            id="area_name"
                            name="area_name"
                            value={this.state.area_name}
                            onChange={this.handleChange}
                            className="form-control"
                            type="text"
                            required
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

              <h3 className="head3">{t("phase.create_area_work")}</h3>
              <div className="card" style={{ maxWidth: "1120px" }}>
                <form
                  onSubmit={
                    this.props.match.params.id
                      ? this.handleAreaPhaseUpdate
                      : this.handleAreaPhaseSubmit
                  }
                >
                  <div className="card-body">
                    <div className="mt-3"></div>
                    <div className="row">
                      <div className="col-xl-4 col-lg-5 col-md-6">
                        <div className="form-group">
                          <label for="area">{t("phase.area_name")}</label>
                          <select
                            onChange={this.handleChange}
                            name="area_phase"
                            value={this.state.area_phase}
                            class="form-control"
                          >
                            <option>--Select--</option>
                            {this.state.area.map(
                              ({ area_id, area_identifier }, index) => (
                                <option value={area_id}>
                                  {area_identifier}
                                </option>
                              )
                            )}
                          </select>
                        </div>
                      </div>
                      <div className="col-xl-4 col-lg-5 col-md-6 offset-xl-1">
                        <div className="form-group">
                          <label for="area_work">{t("phase.work_area")}</label>
                          <input
                            id="area_work"
                            name="area_work"
                            value={this.state.area_work}
                            onChange={this.handleChange}
                            className="form-control"
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

export default withTranslation()(Phase);
