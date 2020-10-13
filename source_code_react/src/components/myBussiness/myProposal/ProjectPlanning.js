import React, { Component } from "react";
import axios from "axios";
import { Helper, url } from "../../../helper/helper";
import Header from "../../shared/Header";
import BussinessSidebar from "../../shared/BussinessSidebar";
import ProjectPlanModal from "../modals/ProjectPlanModal";
import ProjectPlanOpen from "../modals/ProjectPlanOpen";
import { withTranslation } from "react-i18next";

class ProjectPlanning extends Component {
  state = {
    rows: [],
    area: [],
    phases: [],
    row_phase: [],
    phase: "",
    items: "",
    est_time: 0,
    sub_total: 0,
    tax: 0,
    profit: 0,
    tax_calc: 0,
    profit_calc: 0,
    items_cost: 0,
    total: 0,
    type: "",
    loaded: 0,
    template_name: "",
    id: 0,

    left: null,
    right: null,
  };

  componentDidMount = () => {
    this.loadArea();
    this.loadConfig();
  };

  componentDidUpdate(prevProps, prevState) {
    if (prevState.loaded !== this.state.loaded) {
      this.loadTemplate(this.state.template_name);
    }
  }

  handleTemplate = (value) => {
    this.setState({ loaded: 1, template_name: value });
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

  saveData = async () => {
    this.setState({
      items: this.itemsInput.value,
      est_time: this.est_timeInput.value,
      sub_total: this.sub_totalInput.value,
      tax: this.taxInput.value,
      profit: this.profitInput.value,
      tax_calc: this.tax_calcInput.value,
      profit_calc: this.profit_calcInput.value,
      items_cost: this.items_costInput.value,
      total: this.totalInput.value,
    });
  };

  updateData = async () => {
    this.saveData();
    const token = await localStorage.getItem("token");

    const params = {
      items: this.state.items,
      est_time: this.state.est_time,
      sub_total: this.state.sub_total,
      tax: this.state.tax,
      profit: this.state.profit,
      items_cost: this.state.items_cost,
      total: this.state.total,
      tax_calc: this.state.tax_calc,
      profit_calc: this.state.profit_calc,
    };

    axios
      .put(`${url}/api/pro-plan/update/${this.state.template_name}`, null, {
        params: params,
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((res) => {
        this.setState({ error: false, msg: "Updated successfully!" });
        alert(this.state.msg);
        window.location.reload();
      })
      .catch((err) => {
        this.setState({ error: true, msg: err.response.data.error });
        alert("Error occured");
        window.location.reload();
      });
  };

  loadTemplate = async (val) => {
    const token = await localStorage.getItem("token");
    const response = await axios.get(`${url}/api/pro-plan/template/${val}`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    if (response.status === 200) {
      const {
        type,
        items,
        est_time,
        sub_total,
        tax,
        profit,
        tax_calc,
        profit_calc,
        items_cost,
        template_name,
        total,
        id,
      } = response.data;
      this.setState({
        row_phase: JSON.parse(items),
        type: type,
        est_time: est_time,
        sub_total: sub_total,
        tax: tax,
        profit: profit,
        tax_calc: tax_calc,
        profit_calc: profit_calc,
        items_cost: items_cost,
        template_name: template_name,
        total: total,
        id: id,
      });
    }
  };

  loadArea = async () => {
    const token = await localStorage.getItem("token");
    let lang = localStorage.getItem("_lng");
    const response = await axios.get(`${url}/api/pro-plan/area/${lang}`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    if (response.status === 200) {
      this.setState({ area: response.data.data });
    }
  };

  changePhase = (event) => {
    this.setState({ phases: [] });
    const token = localStorage.getItem("token");
    let lang = localStorage.getItem("_lng");
    axios
      .get(`${url}/api/pro-plan/phase/${event.target.value}/${lang}`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        this.setState({ phases: result.data });
      })
      .catch((err) => {
        console.log(err.response);
      });
  };

  handleSelect = (event) => {
    this.setState({ phase: event.target.value });
  };

  removeTemplate = async (id) => {
    const token = await localStorage.getItem("token");
    const response = await axios.delete(`${url}/api/pro-plan/delete/${id}`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    if (response.status === 200) {
      alert("deleted");
      window.location.reload();
    }
  };

  handleAppend = (event) => {
    event.preventDefault();
    let rows = this.state.rows;
    let row_phase = this.state.row_phase;
    if (this.state.phase) {
      rows.push(this.state.phase);
      let keys = ["items", "dur", "cost", "mat"];
      let gg = `${this.state.phase},${0},${0},${0}`.split(",");
      let result = {};
      keys.forEach((key, i) => (result[key] = gg[i]));
      row_phase.push(result);
      this.setState({ rows: rows, row_phase: row_phase });
    }
  };

  render() {
    const { t, i18n } = this.props;

    const commonProps = {
      items: this.state.items,
      est_time: this.state.est_time,
      sub_total: this.state.sub_total,
      tax: this.state.tax,
      profit: this.state.profit,
      tax_calc: this.state.tax_calc,
      profit_calc: this.state.profit_calc,
      items_cost: this.state.items_cost,
      total: this.state.total,
    };

    return (
      <div>
        <Header active={"bussiness"} />
        <div className="sidebar-toggle"></div>
        <nav aria-label="breadcrumb">
          <ol className="breadcrumb">
            <li className="breadcrumb-item ">{t("mycustomer.heading")}</li>
            <li className="breadcrumb-item ">
              {t("b_sidebar.proposal.proposal")}
            </li>
            <li className="breadcrumb-item active" aria-current="page">
              {t("project_planning.heading")}
            </li>
          </ol>
        </nav>
        <div className="main-content">
          <BussinessSidebar dataFromParent={this.props.location.pathname} />
          <div className="page-content">
            <div className="container-fluid">
              <h3 className="head3">{t("project_planning.heading")}</h3>
              <div className="card" style={{ maxWidth: "1150px" }}>
                <div className="card-body">
                  <form>
                    <input
                      type="hidden"
                      ref={(input) => {
                        this.itemsInput = input;
                      }}
                      id="items"
                    />
                    <input
                      type="hidden"
                      ref={(input) => {
                        this.est_timeInput = input;
                      }}
                      id="est_time"
                    />
                    <input
                      type="hidden"
                      ref={(input) => {
                        this.sub_totalInput = input;
                      }}
                      id="sub_total"
                    />
                    <input
                      type="hidden"
                      ref={(input) => {
                        this.taxInput = input;
                      }}
                      id="tax"
                    />
                    <input
                      type="hidden"
                      ref={(input) => {
                        this.profitInput = input;
                      }}
                      id="profit"
                    />
                    <input
                      type="hidden"
                      ref={(input) => {
                        this.tax_calcInput = input;
                      }}
                      id="tax_calc"
                    />
                    <input
                      type="hidden"
                      ref={(input) => {
                        this.profit_calcInput = input;
                      }}
                      id="profit_calc"
                    />
                    <input
                      type="hidden"
                      ref={(input) => {
                        this.items_costInput = input;
                      }}
                      id="items_cost"
                    />
                    <input
                      type="hidden"
                      ref={(input) => {
                        this.totalInput = input;
                      }}
                      id="total"
                    />
                    <div className="row">
                      <div className="col-xl-3 col-lg-4 col-sm-12">
                        <div className="form-group">
                          <label>{t("project_planning.area")}</label>
                          <select
                            onChange={this.changePhase}
                            className="form-control"
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
                      <div className="col-xl-5 col-lg-5 col-md-8 col-sm-12">
                        <div className="form-group">
                          <label>{t("project_planning.phase")}</label>
                          <div className="flex-group">
                            <select
                              onChange={this.handleSelect}
                              name="phase"
                              className="form-control"
                            >
                              <option>--Select--</option>
                              {this.state.phases.map(
                                ({ aw_id, aw_identifier }, index) => {
                                  if (aw_id !== undefined) {
                                    return (
                                      <option value={aw_identifier}>
                                        {aw_identifier}
                                      </option>
                                    );
                                  }
                                }
                              )}
                            </select>
                            <button
                              onClick={this.handleAppend}
                              className="btn btn-primary"
                            >
                              Add
                            </button>

                            {this.state.loaded === 1 ? (
                              <button
                                onClick={() =>
                                  this.removeTemplate(this.state.id)
                                }
                                className="btn btn-danger"
                              >
                                Delete
                              </button>
                            ) : null}
                          </div>
                        </div>
                      </div>
                      <div className="col-xl-4 col-lg-3 col-md-4 col-sm-12">
                        <div className="form-group text-right">
                          <label className="d-xl-none">&nbsp;</label>
                          <div className="dropdown mt-2">
                            <a
                              className="btn btn-light dropdown-toggle"
                              type="button"
                              data-toggle="dropdown"
                              aria-haspopup="true"
                              aria-expanded="false"
                            >
                              {t("project_planning.template")}
                            </a>
                            <div className="dropdown-menu dropdown-menu-right">
                              {this.state.loaded === 1 ? (
                                <button
                                  onClick={this.updateData}
                                  className="dropdown-item clk"
                                >
                                  {t("project_planning.upd_curr")}
                                </button>
                              ) : (
                                <button
                                  onClick={this.saveData}
                                  data-toggle="modal"
                                  data-target="#save"
                                  className="dropdown-item clk"
                                >
                                  {t("project_planning.save_curr")}
                                </button>
                              )}
                              <button
                                data-toggle="modal"
                                data-target="#open"
                                className="dropdown-item"
                              >
                                {t("project_planning.save_temp")}
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <div className="mt-4"></div>
                  <h6 className="head6">{t("project_planning.new_task")}</h6>
                  <div className="table-responsive scroller">
                    <ProjectPlanModal data={commonProps} />
                    <ProjectPlanOpen onSelectedName={this.handleTemplate} />

                    <table
                      id="mytable"
                      className="table table-bordered table-sm"
                    >
                      <thead>
                        <tr className="text-right">
                          <th className="text-left">
                            {t("project_planning.items")}
                          </th>
                          <th>{t("project_planning.duration")}</th>
                          <th>{t("project_planning.cost_hr")}</th>
                          <th>{t("project_planning.total_cost")}</th>
                        </tr>
                      </thead>
                      <tbody>
                        {this.state.row_phase.map((r, index) => (
                          <Row phase={r} key={index} items={this.state.items} />
                        ))}

                        <tr
                          style={{ lineHeight: "30px", fontWeight: "bold" }}
                          className="text-right"
                        >
                          <td data-label="Items: ">
                            {t("project_planning.est_time")}
                          </td>
                          <td data-label="Duration(hrs): " id="1result">
                            {this.state.est_time}
                          </td>
                          <td data-label="Cost/hr: "></td>
                          <td data-label="Total cost: "></td>
                        </tr>
                        <tr>
                          <td data-label="Items: ">&nbsp;</td>
                          <td data-label="Duration(hrs): "></td>
                          <td data-label="Cost/hr: "></td>
                          <td data-label="Total cost: "></td>
                        </tr>
                        <tr className="text-right">
                          <td data-label="Items: "></td>
                          <td data-label="Duration(hrs): ">
                            {this.state.left} {t("project_planning.sub_total")}{" "}
                            {this.state.right}
                          </td>
                          <td data-label="Cost/hr: " id="2result">
                            {this.state.sub_total}
                          </td>
                          <td data-label="Total cost: " id="3result">
                            {this.state.items_cost}
                          </td>
                        </tr>
                        <tr className="text-right">
                          <td data-label="Items: ">
                            {t("project_planning.tax")}%
                          </td>
                          <td
                            data-label="Duration(hrs): "
                            className="tax"
                            contenteditable="true"
                          >
                            {this.state.tax}
                          </td>
                          <td
                            colSpan="2"
                            data-label="Total cost: "
                            className="tax_res"
                          >
                            {this.state.tax_calc}
                          </td>
                        </tr>
                        <tr className="text-right">
                          <td data-label="Items: ">
                            {t("project_planning.profit")}%
                          </td>
                          <td
                            data-label="Duration(hrs): "
                            className="profit"
                            contenteditable="true"
                          >
                            {this.state.profit}
                          </td>
                          <td data-label="Duration(hrs): "></td>
                          <td data-label="Total cost: " className="profit_res">
                            {this.state.profit_calc}
                          </td>
                        </tr>
                        <tr className="text-right">
                          <td data-label="Items: ">
                            {this.state.left} {t("project_planning.total")}{" "}
                            {this.state.right}
                          </td>
                          <td
                            colSpan="3"
                            data-label="Duration(hrs): "
                            className="total"
                          >
                            {this.state.total}
                          </td>
                        </tr>
                      </tbody>
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

const Row = (props) => (
  <tr className="text-right i-val customerIDCell">
    <td
      data-value={props.phase.items}
      className="text-left "
      data-label="Items: "
    >
      <span class="remove-row" id="myRemove">
        ×
      </span>
      {props.phase.items}
    </td>
    <td
      className="duration "
      contenteditable="true"
      data-label="Duration(hrs): "
    >
      {props.phase.dur}
    </td>
    <td className="cost_hr " contenteditable="true" data-label="Cost/hr: ">
      {props.phase.cost}
    </td>
    <td className="mat_cost" data-label="Total cost: ">
      {props.phase.mat}
    </td>
  </tr>
);

export default withTranslation()(ProjectPlanning);
