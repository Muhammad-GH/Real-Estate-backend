import React, { Component } from "react";
import axios from "axios";
import { Helper, url } from "../../../helper/helper";

export default class ProjectPlanModal extends Component {
  state = {
    template_name: "",
    type: "",
    error: Boolean,
    msg: "",
  };

  handleTemplateName = (event) => {
    const { name, value } = event.target;
    this.setState({ [name]: value });
  };

  handleSubmit = async () => {
    const token = await localStorage.getItem("token");
    const data = new FormData();
    data.set("items", this.props.data.items);
    data.set("est_time", this.props.data.est_time);
    data.set("sub_total", this.props.data.sub_total);
    data.set("tax", this.props.data.tax);
    data.set("profit", this.props.data.profit);
    data.set("items_cost", this.props.data.items_cost);
    data.set("template_name", this.state.template_name);
    data.set("type", this.state.type);
    data.set("total", this.props.data.total);
    data.set("tax_calc", this.props.data.tax_calc);
    data.set("profit_calc", this.props.data.profit_calc);
    data.set("seperate", 0);

    axios
      .post(`${url}/api/pro-plan/create`, data, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((res) => {
        this.setState({ error: false, msg: "Saved successfully!" });
        console.log(res);
      })
      .catch((err) => {
        this.setState({ error: true, msg: err.response.data.error });
        console.log(err.response.data);
      });
  };

  render() {
    if (this.state.msg) {
      alert(this.state.msg);
      window.location.reload();
    }
    return (
      <div>
        <div
          className="modal fade"
          id="save"
          tabIndex="-1"
          role="dialog"
          aria-labelledby="exampleModalLabel"
          aria-hidden="true"
        >
          <div className="modal-dialog modal-lg modal-dialog-centered">
            <div className="modal-content">
              <div className="modal-body">
                <div className="row">
                  <div className="col-md-11">
                    <div className="form-group mb-5">
                      <div className="profile flex">
                        <div className="content">
                          <h4>Enter a unique plan name</h4>
                        </div>
                      </div>
                    </div>
                    <div className="form-group ">
                      <input
                        className="form-control"
                        placeholder="...."
                        name="template_name"
                        onChange={this.handleTemplateName}
                      />
                    </div>
                    <div className="form-group ">
                      <select
                        onChange={this.handleTemplateName}
                        name="type"
                        class="form-control"
                      >
                        <option>--Type--</option>
                        <option>Work</option>
                        <option>Material</option>
                      </select>
                    </div>
                    <button
                      type="button"
                      className="btn btn-outline-dark mt-3"
                      data-dismiss="modal"
                      aria-label="Close"
                      onClick={this.handleSubmit}
                    >
                      Save
                    </button>
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
