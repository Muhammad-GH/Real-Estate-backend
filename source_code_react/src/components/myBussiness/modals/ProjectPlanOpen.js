import React, { Component } from "react";
import axios from "axios";
import { Helper, url } from "../../../helper/helper";

class ProjectPlanOpen extends Component {
  state = {
    template_names: [],
    name: "",
  };

  componentDidMount = () => {
    this.loadNames();
  };

  handleName = (event) => {
    this.setState({ name: event.target.value });
  };

  SendName = () => {
    this.props.onSelectedName(this.state.name);
  };

  loadNames = async () => {
    const token = await localStorage.getItem("token");
    const response = await axios.get(`${url}/api/pro-plan/names/all`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    if (response.status === 200) {
      this.setState({ template_names: response.data.data });
    }
  };

  render() {
    return (
      <div>
        <div
          className="modal fade"
          id="open"
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
                          <h4>Select a template</h4>
                        </div>
                      </div>
                    </div>
                    <div className="form-group ">
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
                    <button
                      type="button"
                      className="btn btn-outline-dark mt-3"
                      data-dismiss="modal"
                      aria-label="Close"
                      onClick={this.SendName}
                    >
                      Open
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

export default ProjectPlanOpen;
