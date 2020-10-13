import React, { Component } from "react";
import axios from "axios";
import { Helper, url } from "../../../helper/helper";
import { withTranslation } from "react-i18next";

const initialState = {
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
  loaded: false,
  template_name: "",
  template_names: [],
  id: 0,
};

class ProjectPlanProposal extends Component {
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
    loaded: false,
    template_name: "",
    template_names: [],
    id: 0,
  };

  componentDidUpdate(prevProps) {
    // Typical usage (don't forget to compare props):
    if (this.props.onType !== prevProps.onType) {
      this.setState(initialState);
      this.setState({ row_phase: [] });
      this.loadNames(this.props.onType);
      this.loadArea();
    }
    if (this.props.tempName !== prevProps.tempName) {
      this.setState(initialState);
      this.setState({ loaded: true });
      this.loadNames(this.props.onType);
      this.loadArea();
      this.loadTemplate(this.props.tempName);
    }
  }

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

  handleItemsAdd = () => {
    if (this.state.id === 0) {
      const token = localStorage.getItem("token");
      const params = {
        items: this.itemsInput.value,
        est_time: this.est_timeInput.value,
        sub_total: this.sub_totalInput.value,
        tax: this.taxInput.value,
        profit: this.profitInput.value,
        tax_calc: this.tax_calcInput.value,
        profit_calc: this.profit_calcInput.value,
        items_cost: this.items_costInput.value,
        total: this.totalInput.value,
        type: this.props.onType,
        seperate: 1,
        template_name: `${+new Date()}_${this.props.onType}`,
      };

      axios
        .post(`${url}/api/pro-plan/create`, params, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        })
        .then((res) => {
          this.setState({ id: res.data });
          this.props.onSelectWorkTemplate(
            this.itemsInput.value,
            this.totalInput.value,
            this.props.onType,
            this.state.template_name,
            this.state.id
          );
          console.log(res);
        })
        .catch((err) => {
          console.log(err.response.data);
        });
    } else {
      this.props.onSelectWorkTemplate(
        this.itemsInput.value,
        this.totalInput.value,
        this.props.onType,
        this.state.template_name,
        this.state.id
      );
    }

    // this.props.onSelectWorkTemplate(
    //   this.itemsInput.value,
    //   this.totalInput.value,
    //   this.props.onType,
    //   this.state.template_name,
    //   this.state.id
    // );
  };

  updateData = async (event) => {
    // event.preventDefault()
    this.saveData();
    this.props.onSelectWorkTemplate(
      this.itemsInput.value,
      this.totalInput.value,
      this.props.onType,
      this.state.template_name
    );
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

  handleName = (event) => {
    if (event.target.value !== "--Name--") {
      this.setState({ template_name: event.target.value, loaded: true });
      this.loadTemplate(event.target.value);
    }
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

  loadNames = async (val) => {
    const token = await localStorage.getItem("token");
    const response = await axios.get(`${url}/api/pro-plan/names/${val}`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    if (response.status === 200) {
      this.setState({ template_names: response.data.data });
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
      this.setState({ rows: rows, row_phase: row_phase, loaded: true });
    }
  };

  render() {
    const { t, i18n } = this.props;

    return (
      <div>
        <div
          class="modal fade"
          id="add-plan"
          tabindex="-1"
          role="dialog"
          aria-labelledby="exampleModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                  {t("modals.project_plan.heading")}
                </h5>
                <button
                  type="button"
                  class="close"
                  data-dismiss="modal"
                  aria-label="Close"
                >
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
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

                <div class="row">
                  <div class="col-md">
                    <div class="form-group">
                      <label>{t("modals.project_plan.select_area")}</label>
                      <select
                        onChange={this.changePhase}
                        className="form-control"
                      >
                        <option>--Select--</option>
                        {this.state.area.map(
                          ({ area_id, area_identifier }, index) => (
                            <option value={area_id}>{area_identifier}</option>
                          )
                        )}
                      </select>
                    </div>
                  </div>

                  <div class="col-md">
                    <div class="form-group">
                      <label>{t("modals.project_plan.template_name")}</label>
                      <div class="flex-group">
                        <select
                          onChange={this.handleName}
                          name="type"
                          class="form-control"
                        >
                          <option>--Name--</option>
                          {this.state.template_names.map(
                            ({ template_name }, index) => (
                              <option value={template_name}>
                                {template_name}
                              </option>
                            )
                          )}
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>{t("modals.project_plan.add_work_phase")}</label>
                      <div class="flex-group">
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
                          class="btn btn-primary"
                        >
                          {t("modals.project_plan.add")}
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <p>{t("modals.project_plan.note")} </p>
                <div class="table-responsive-sm scroller mt-3">
                  <table id="mytable" className="table table-bordered table-sm">
                    <thead>
                      <tr className="text-right">
                        <th className="text-left">
                          {t("modals.project_plan.items")}
                        </th>
                        <th>{t("modals.project_plan.duration")}</th>
                        <th>{t("modals.project_plan.cost_hr")}</th>
                        <th>{t("modals.project_plan.total_cost")}</th>
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
                          {this.props.left} {t("project_planning.sub_total")}{" "}
                          {this.props.right}
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
                          {this.props.left} {t("project_planning.total")}{" "}
                          {this.props.right}
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
                  <button
                    onClick={this.handleItemsAdd}
                    data-dismiss="modal"
                    aria-label="Close"
                    disabled={!this.state.loaded}
                    type="button"
                    class="btn btn-primary mt-3 clk1"
                  >
                    {t("modals.project_plan.add_to_proposal")}
                  </button>
                  <button
                    style={{ float: "right" }}
                    data-dismiss="modal"
                    aria-label="Close"
                    disabled={!this.state.loaded}
                    type="button"
                    onClick={this.updateData}
                    class="btn btn-success mt-3 clk"
                  >
                    {t("modals.project_plan.update_proposal")}
                  </button>
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

export default withTranslation()(ProjectPlanProposal);
