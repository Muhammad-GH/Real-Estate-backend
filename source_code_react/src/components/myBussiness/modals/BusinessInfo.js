import React, { Component } from "react";
import axios from "axios";
import { Helper, url } from "../../../helper/helper";

class BusinessInfo extends Component {

    state = {
        first_name:'',
        last_name:'',
        address:'',
        email:'',
        phone:'',
        zip:'',
        company_id:'',
        company_website:'',
        password:'',
        old_password:'',
        info:[],
        success:Boolean,
        errors:[],
    }

  componentDidMount = () => {
    this.loadData();
  };

  handleChange = event => {
    const {name, value} = event.target
    this.setState({[name]: value})
  }

  loadData = async () => {
    const token = localStorage.getItem("token");
    const { data } = await axios.get(`${url}/api/account`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    this.setState({ info: data });
    this.props.onInfo(this.state.info)
  };

  handleSubmit = async event => {
    event.preventDefault()
    const data = new FormData() 
    data.set('first_name', this.state.first_name)
    data.set('last_name', this.state.last_name)
    data.set('address', this.state.address)
    data.set('email', this.state.email)
    data.set('phone', this.state.phone)
    data.set('zip', this.state.zip)
    data.set('company_id', this.state.company_id)
    data.set('company_website', this.state.company_website)

    const token =await localStorage.getItem('token')
    axios.post(`${url}/api/storeDetails`, data, {
      headers: {
        'Authorization': `Bearer ${token}`,
        }}).then((result) => {
          return alert('Updated')
          window.location.reload()
        }).catch((err) => {
          return window.location.reload()
          // return alert('Error occured ')
        })
  }

  render() {
    return (
      <div>
        <div
          class="modal fade"
          id="edit-info"
          tabindex="-1"
          role="dialog"
          aria-labelledby="editInfoModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editInfoModalLabel">
                  Edit Business Information
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
                <form onSubmit={this.handleSubmit}>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="f-name">First Name</label>
                        <input
                          id="f-name" onChange={this.handleChange}
                          name="first_name"
                          class="form-control"
                          type="text"
                          placeholder={this.state.info.first_name}
                        />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="l-name">Last Name</label>
                        <input
                          id="l-name" onChange={this.handleChange}
                          name="last_name"
                          class="form-control"
                          type="text"
                          placeholder={this.state.info.last_name}
                        />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="address">Address</label>
                        <input
                          id="address" onChange={this.handleChange}
                          name="address"
                          class="form-control"
                          type="text"
                          placeholder={this.state.info.address}
                        />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="zip">Zip</label>
                        <input
                          id="zip" onChange={this.handleChange}
                          name="zip"
                          class="form-control"
                          type="text"
                          placeholder={this.state.info.zip}
                        />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="phone">Phone</label>
                        <input
                          id="phone" onChange={this.handleChange}
                          name="phone"
                          class="form-control"
                          type="text"
                          placeholder={this.state.info.phone}
                        />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input
                          id="email" onChange={this.handleChange}
                          name="email"
                          class="form-control"
                          type="email"
                          placeholder={this.state.info.email}
                        />
                      </div>
                    </div>
                    <div className="col-md-6">
                        <div className="form-group">
                          <label for="company_id">Customer ID</label>
                          <input name="company_id" onChange={this.handleChange}
                            id="company_id" placeholder={this.state.info.company_id}
                            className="form-control"
                            type="text"
                          />
                        </div>
                      </div>
                      
                      <div className="col-md-6">
                        <div className="form-group">
                          <label for="company_website">Customer Website</label>
                          <input name="company_website" onChange={this.handleChange}
                            id="company_website" placeholder={this.state.info.company_website}
                            className="form-control"
                            type="text"
                          />
                        </div>
                      </div>
                  </div>
                  <button type="submit" class="btn btn-primary mt-3">
                    Submit
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

export default BusinessInfo;
